
import cv2
import datetime
import random


# ------------ This script will be launched if you clicked "Open camera" in "Camera" ------------

def change_date_format(ch):
    ch2 = ""
    for i in ch:
        if (i==':'):
            i = ';'
        ch2 = ch2+i
    return ch2


b = True
while (b):
    try:
        cap = cv2.VideoCapture('http://admin:@192.168.22.37/video/mjpg.cgi?profileid=3')
        # cap = cv2.VideoCapture(0)      # Uncomment this and comment the line above to open your webcam

        ret, frame1 = cap.read()
        ret, frame2 = cap.read()

        k = 0
        L = 0
        while (cap.isOpened()):
            diff = cv2.absdiff(frame1, frame2)   # Find out the difference between the first frame and the second frame
            gray = cv2.cvtColor(diff, cv2.COLOR_BGR2GRAY)   # Gray is easier to find the contours
            blur = cv2.GaussianBlur(gray, (5, 5), 0)        # To remove the noise
            _, thresh = cv2.threshold(blur, 20, 255, cv2.THRESH_BINARY)
            dilated = cv2.dilate(thresh, None, iterations=3)    # Improve the mask
            contours, _ = cv2.findContours(dilated, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)    # find the contours
            for contour in contours:
                (x, y, w, h) = cv2.boundingRect(contour)   # x, y, width, height

                if (cv2.contourArea(contour) < 1000):       # Don't draw on small objects
                    continue
                k = k+1
                if (k>=20):
                    datet = str(datetime.datetime.now())  # Get the date
                    datet = change_date_format(datet)
                    cv2.imwrite('unprocessed images/' + str(datet) + ' (' + str(random.randint(1, 999999999)) + ')' + '.jpg', frame1)

                    L = L+1
                    k = 0

            cv2.imshow("Camera", frame1)
            frame1 = frame2
            ret, frame2 = cap.read()    # To read the next frame

            if (cv2.waitKey(40) == 27):
                b = False
                break

        cv2.destroyAllWindows()
        cap.release()

    except:
        continue

