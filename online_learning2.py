from __future__ import absolute_import, division, print_function, unicode_literals

import random as rd
import shutil
import os
import numpy as np
import matplotlib.pyplot as plt
import tensorflow as tf
from sklearn.externals import joblib
tf.enable_eager_execution()

import tensorflow_hub as hub

from tensorflow.keras import layers
import logging
logger = tf.get_logger()
logger.setLevel(logging.ERROR)


# ------------ This script will be launched if you clicked "Start training" in "Add an employee" ------------

def prepare_data():
    L = os.listdir(r"C:\MAMP\htdocs\worker faces")
    for ch in L:
        dir = "C:/MAMP/htdocs/worker faces/" + ch
        L2 = os.listdir(dir)
        count_validation = int(0.2*len(L2))
        rd.shuffle(L2)
        i = 0
        while(i<count_validation):
            dir2 = "C:/MAMP/htdocs/validation/"+ch+'/'+L2[i]
            pic = dir + '/' + L2[i]
            try:
                shutil.move(pic, dir2)
            except:
                os.mkdir("C:/MAMP/htdocs/validation/"+ch)
                shutil.move(pic, dir2)
            i = i+1


prepare_data()
base_dir = r"C:\MAMP\htdocs"
train_dir = r"C:\MAMP\htdocs\worker faces"
validation_dir = r"C:\MAMP\htdocs\validation"

L1 = os.listdir(train_dir)
total_train = 0
for ch in L1:
    dir = "C:/MAMP/htdocs/worker faces/" + ch
    list = os.listdir(dir)
    number_of_pictures = len(list)
    total_train = total_train + number_of_pictures

L2 = os.listdir(validation_dir)
total_val = 0
m = 0
for ch in L2:
    dir = "C:/MAMP/htdocs/validation/" + ch
    list = os.listdir(dir)
    number_of_pictures = len(list)
    total_val = total_val + number_of_pictures
    m = m + 1

print("Total training images:", total_train)
print("Total validation images:", total_val)

if(total_train>0 and total_val>0):

    BATCH_SIZE = 100
    IMG_SHAPE = 224

    image_gen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1./255, horizontal_flip=True)

    train_data_gen = image_gen.flow_from_directory(batch_size=BATCH_SIZE,
                                                   directory=train_dir,
                                                   shuffle=True,
                                                   target_size=(IMG_SHAPE,IMG_SHAPE))

    augmented_images = [train_data_gen[0][0][0] for i in range(5)]

    image_gen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1./255, rotation_range=45)

    train_data_gen = image_gen.flow_from_directory(batch_size=BATCH_SIZE,
                                                   directory=train_dir,
                                                   shuffle=True,
                                                   target_size=(IMG_SHAPE, IMG_SHAPE))

    augmented_images = [train_data_gen[0][0][0] for i in range(5)]

    image_gen = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1./255, zoom_range=0.5)

    train_data_gen = image_gen.flow_from_directory(batch_size=BATCH_SIZE,
                                                   directory=train_dir,
                                                   shuffle=True,
                                                   target_size=(IMG_SHAPE, IMG_SHAPE))

    augmented_images = [train_data_gen[0][0][0] for i in range(5)]

    image_gen_train = tf.keras.preprocessing.image.ImageDataGenerator(
        rescale=1./255,
        rotation_range=40,
        width_shift_range=0.2,
        height_shift_range=0.2,
        shear_range=0.2,
        zoom_range=0.2,
        horizontal_flip=True,
        fill_mode='nearest')

    train_data_gen = image_gen_train.flow_from_directory(batch_size=BATCH_SIZE,
                                                         directory=train_dir,
                                                         shuffle=True,
                                                         target_size=(IMG_SHAPE,IMG_SHAPE),
                                                         class_mode='sparse')

    augmented_images = [train_data_gen[0][0][0] for i in range(5)]

    image_gen_val = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1./255)

    val_data_gen = image_gen_val.flow_from_directory(batch_size=BATCH_SIZE,
                                                     directory=validation_dir,
                                                     target_size=(IMG_SHAPE, IMG_SHAPE),
                                                     class_mode='sparse')   # class_mode='binary' if the model contains only two classes

    L = os.listdir('C:/MAMP/htdocs/saved_models')
    if (len(L) > 0):
        feature_extractor = tf.keras.experimental.load_from_saved_model('C:/MAMP/htdocs/saved_models',
                                                                        custom_objects={'KerasLayer': hub.KerasLayer})

        feature_extractor.build((None, 224, 224, 3))

        model = tf.keras.models.Sequential()
        for layer in feature_extractor.layers[:-1]:
            model.add(layer)
        for layer in model.layers:
            layer.trainable = False
        model.add(tf.keras.layers.Dense(m, activation='softmax', name="output"))

        epochs = 20
    else:
        URL = "https://tfhub.dev/google/tf2-preview/mobilenet_v2/feature_vector/2"
        feature_extractor = hub.KerasLayer(URL,
                                           input_shape=(224, 224, 3))

        feature_extractor.trainable = False

        model = tf.keras.Sequential([
            feature_extractor,
            tf.keras.layers.Dense(m, activation='softmax', name="output")
        ])
        epochs = 100

    model.summary()

    model.compile(optimizer='adam',
                  loss='sparse_categorical_crossentropy',
                  metrics=['accuracy'])

    earlystop_callback = tf.keras.callbacks.EarlyStopping(
        monitor='val_accuracy', min_delta=0.0001,
        patience=2)

    epochs = 20
    history = model.fit_generator(
        train_data_gen,
        steps_per_epoch=int(np.ceil(total_train / float(BATCH_SIZE))),
        epochs=epochs,
        callbacks=[earlystop_callback],
        validation_data=val_data_gen,
        validation_steps=int(np.ceil(total_val / float(BATCH_SIZE)))
    )

    acc = history.history['acc']
    val_acc = history.history['val_acc']

    loss = history.history['loss']
    val_loss = history.history['val_loss']

    epochs_range = range(epochs)

    fig = plt.figure(figsize=(8, 8))
    plt.subplot(1, 2, 1)
    plt.plot(epochs_range, acc, label='Training Accuracy')
    plt.plot(epochs_range, val_acc, label='Validation Accuracy')
    plt.legend(loc='lower right')
    plt.title('Training and Validation Accuracy')

    plt.subplot(1, 2, 2)
    plt.plot(epochs_range, loss, label='Training Loss')
    plt.plot(epochs_range, val_loss, label='Validation Loss')
    plt.legend(loc='upper right')
    plt.title('Training and Validation Loss')
    # plt.show()

    fig.savefig('C:/MAMP/htdocs/my_plot.png')
    mydir = "C:/MAMP/htdocs/saved_models"
    L = os.listdir(mydir)
    if (len(L)>0):
        for i in L:
            ch = mydir + '/' + i
            try:
                shutil.rmtree(ch)
            except:
                os.remove(ch)

    export_path = tf.keras.experimental.export_saved_model(model, r'C:\MAMP\htdocs\saved_models')

    label_names = sorted(train_data_gen.class_indices.items(), key=lambda pair:pair[1])
    label_names = np.array([key.title() for key, value in label_names])

    L = os.listdir(r"C:\MAMP\htdocs\validation")
    for ch in L:
        dir = "C:/MAMP/htdocs/validation/" + ch
        L2 = os.listdir(dir)
        for ch2 in L2:
            dir2 = "C:/MAMP/htdocs/worker faces/" + ch + '/' + ch2
            pic = dir + '/' + ch2
            try:
                shutil.move(pic, dir2)
            except:
                os.mkdir("C:/MAMP/htdocs/worker faces/" + ch)
                shutil.move(pic, dir2)

    L2 = os.listdir(r"C:\MAMP\htdocs\validation")
    if (len(L2) > 0):
        for i in L2:
            ch = 'C:/MAMP/htdocs/validation/' + i
            try:
                shutil.rmtree(ch)
            except:
                os.remove(ch)
