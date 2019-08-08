
from imageai.Detection import ObjectDetection
import os


# ------------ This script will be used by "check_person.py" ------------

def person(path):
    execution_path = os.getcwd()

    detector = ObjectDetection()
    detector.setModelTypeAsRetinaNet()
    detector.setModelPath(r"C:\MAMP\htdocs\resnet50_coco_best_v2.0.1.h5")
    detector.loadModel()

    detections = detector.detectObjectsFromImage(input_image=os.path.join(execution_path, path),
                                                 output_image_path=r"C:\MAMP\htdocs\imagenew.jpeg")

    for eachObject in detections:
        if (eachObject["name"] == 'person'):
            return True

    return False




