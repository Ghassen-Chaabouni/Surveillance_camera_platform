import os
import pandas as pd
import shutil
from person import person
import random
from PIL import Image


def get_date(ch):
    ch2 = ''
    for i in ch:
        if(i==':'):
            ch2 = ch2+';'
            continue
        ch2 = ch2+i
    return ch2


# ------------ This script will be launched if you clicked "Check persons" button in "Camera" ------------

def check_person():

        L = os.listdir(r"C:\MAMP\htdocs\unprocessed images")
        for ch in L:
            pic = "C:/MAMP/htdocs/unprocessed images/" + ch
            b = person(pic)
            if (b):
                shutil.move(pic, r"C:\MAMP\htdocs\check faces")
            else:
                shutil.move(pic, r"C:\MAMP\htdocs\not a person")

        dataset2 = pd.read_csv(r'C:\MAMP\htdocs\dataset2.csv')
        dataset2 = dataset2[0:0]
        dataset2.to_csv(r'C:\MAMP\htdocs\dataset2.csv', index=False)
        L2 = os.listdir(r"C:\MAMP\htdocs\check faces")
        for i in range(len(L2)-1):
            pic1302 = "check faces/" + L2[i]
            date = L2[i]
            dataset2 = dataset2.append({'Time': date, 'Picture': pic1302}, ignore_index=True)

        dataset2.to_csv(r'C:\MAMP\htdocs\dataset2.csv', index=False)
        dataset2 = pd.read_csv(r'C:\MAMP\htdocs\dataset2.csv')

        dict = {}
        for i in range(dataset2.shape[0]):

            ch = dataset2['Time'][i]
            if int(ch[17:19]) <= 14:
                key = ch[:16] + ':' + '15'
            elif (int(ch[17:19]) >=15) and (int(ch[17:19]) < 30):
                key = ch[:16] + ':' + '30'
            elif (int(ch[17:19]) >=30) and (int(ch[17:19]) < 45):
                key = ch[:16] + ':' + '45'
            elif (int(ch[17:19]) >=45) and (int(ch[17:19]) < 60):
                key = ch[:16] + ':' + '59'

            dict.setdefault(key, [])
            dict[key].append(dataset2['Picture'][i])

        for key in dict.keys():
            new_width = 0
            stop = 0
            for value in dict[key]:
                value2 = 'C:/MAMP/htdocs/' + value
                img = Image.open(str(value2))
                new_width = new_width + img.size[0]
                img.close()
                stop = stop + 1
                if (stop >= 3):
                    break

            new_image = Image.new('RGB', (new_width, img.size[1]), 'white')
            A = 0
            B = img.size[0]
            a = 0
            b = 0
            stop2 = 0
            for value in dict[key]:
                try:
                    value2 = 'C:/MAMP/htdocs/' + value
                    img = Image.open(str(value2))
                    new_image.paste(img, (A + a, 0, B + b, img.size[1]))
                    A = A + img.size[0]
                    B = B + img.size[0]
                    a = a + 30
                    b = b + 30
                    stop2 = stop2 + 1
                    if (stop2 >= 3):
                        break
                except:
                    continue
            for value in dict[key]:
                try:
                    os.remove(str(value))
                except:
                    continue

            key = get_date(key[:19])
            new_image.save('C:/MAMP/htdocs/check faces/' + str(key) + ' (' + str(random.randint(1, 999999999)) + ')' + '.jpg')


try:
    L = os.listdir(r"C:\MAMP\htdocs\unprocessed images")
    if(len(L)>0):
        check_person()     # Object detection to remove the pictures that don't contain humans
except:
    pass
