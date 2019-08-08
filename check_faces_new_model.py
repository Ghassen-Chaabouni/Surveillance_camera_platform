from __future__ import absolute_import, division, print_function, unicode_literals

import tensorflow as tf
import csv
import mysql.connector
import tensorflow_hub as hub
import numpy as np
import sys
import logging
logger = tf.get_logger()
logger.setLevel(logging.ERROR)

import os
import pandas as pd
import shutil


# ------------ This script will be launched if you clicked "Check faces" button in "Camera" ------------

def predict(path_to_folder):
    BATCH_SIZE = 100
    IMG_SHAPE = 224
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    train_dir = r"C:\MAMP\htdocs\worker faces" + db_num

    model = tf.keras.experimental.load_from_saved_model(r"C:\MAMP\htdocs\saved_models" + db_num,
                                                        custom_objects={'KerasLayer': hub.KerasLayer})

    image_gen_val = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1. / 255)

    train_data_gen = image_gen_val.flow_from_directory(batch_size=BATCH_SIZE,
                                                       directory=train_dir,
                                                       shuffle=False,
                                                       target_size=(IMG_SHAPE, IMG_SHAPE))

    label_names = sorted(train_data_gen.class_indices.items(), key=lambda pair: pair[1])
    label_names = np.array([key.title() for key, value in label_names])
    test_data_gen = image_gen_val.flow_from_directory(batch_size=BATCH_SIZE,
                                                      directory=path_to_folder,
                                                      target_size=(IMG_SHAPE, IMG_SHAPE),
                                                      class_mode='sparse')

    result_batch = model.predict(test_data_gen)
    labels_batch = label_names[np.argmax(result_batch, axis=-1)]

    return labels_batch


def predict2(path_to_folder):
    BATCH_SIZE = 100
    IMG_SHAPE = 224
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    train_dir = r"C:\MAMP\htdocs\enter_exit" + db_num

    model = tf.keras.experimental.load_from_saved_model(r"C:\MAMP\htdocs\enter_exit_saved_model" + db_num,
                                                        custom_objects={'KerasLayer': hub.KerasLayer})

    image_gen_val = tf.keras.preprocessing.image.ImageDataGenerator(rescale=1. / 255)

    train_data_gen = image_gen_val.flow_from_directory(batch_size=BATCH_SIZE,
                                                       directory=train_dir,
                                                       shuffle=False,
                                                       target_size=(IMG_SHAPE, IMG_SHAPE))

    label_names = sorted(train_data_gen.class_indices.items(), key=lambda pair: pair[1])
    label_names = np.array([key.title() for key, value in label_names])
    test_data_gen = image_gen_val.flow_from_directory(batch_size=BATCH_SIZE,
                                                      directory=path_to_folder,
                                                      target_size=(IMG_SHAPE, IMG_SHAPE),
                                                      class_mode='binary')

    result_batch = model.predict(test_data_gen)
    labels_batch = label_names[np.argmax(result_batch, axis=-1)]

    return labels_batch


def get_date(ch):
    ch2 = ""
    for i in ch:
        if(i==';'):
            i = ':'
        if (i == '-'):
            i = '_'
        if(i=='('):
            break
        ch2 = ch2+i
    return ch2


def prepare_data():
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    L = os.listdir(r"C:\MAMP\htdocs\check faces" + db_num)
    for ch in L:
        pic = "C:/MAMP/htdocs/check faces" + db_num + "/"+ch
        shutil.move(pic, r"C:\MAMP\htdocs\check faces" + db_num + "/check")


def check_faces():
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    prepare_data()
    dataset = pd.read_csv(r'C:\MAMP\htdocs\dataset_' + db_num + '.csv')
    dataset = dataset[0:0]
    dataset.to_csv(r'C:\MAMP\htdocs\dataset_' + db_num + '.csv', index=False)

    dataset = pd.read_csv(r'C:\MAMP\htdocs\dataset_' + db_num + '.csv')

    L = os.listdir(r"C:\MAMP\htdocs\check faces" + db_num + "/check")
    names = predict(r"C:\MAMP\htdocs\check faces" + db_num)        # face recognition
    enter_exit = predict2(r"C:\MAMP\htdocs\check faces" + db_num)  # Enter/Exit classification
    i = -1
    for ch in L:
            i = i+1
            pic = "C:/MAMP/htdocs/check faces" + db_num + "/check/" + ch
            name = names[i]
            date = get_date(ch)
            dataset = dataset.append({'Name': name, 'Enter_Exit': enter_exit[i].lower(), 'Time': str(date), 'Picture': "finish check faces" + db_num + "/" + ch}, ignore_index=True)
            try:
                shutil.move(pic, r"C:\MAMP\htdocs\finish check faces" + db_num)
            except:
                continue
    dataset.to_csv(r'C:\MAMP\htdocs\dataset_' + db_num + '.csv', index=False)


def database():
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    config = {
        'user': 'root',
        'password': 'root',
        'host': 'localhost',
        'database': 'database' + db_num,
        'raise_on_warnings': True,
    }

    con = mysql.connector.connect(**config)

    cur = con.cursor()
    with open(r"C:\MAMP\htdocs\dataset_" + db_num + ".csv", "r") as csv_file:
        next(csv_file)
        csv_reader = csv.reader(csv_file, delimiter=',')
        for lines in csv_reader:
            cur.execute(
                "INSERT INTO `database`(`Name`, `Enter_Exit`, `Time`, `Picture`) VALUES (%s, %s, %s, %s)",
                (lines[0], lines[1], lines[2], lines[3]))

    cur.close()
    con.commit()
    con.close()


try:
    db_num = str(sys.argv[1])[1:len(str(sys.argv[1]))-1]
    L = os.listdir(r"C:\MAMP\htdocs\check faces" + db_num)
    if(len(L)>1):
        check_faces()   # face recognition and Enter/Exit classification
        database()      # Write the results in a database
except:
    pass
