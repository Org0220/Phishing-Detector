from flask import Flask, request
from joblib import Parallel, delayed 
import joblib


# Test an input mail
reg_from_joblib = joblib.load('./Phishing-Detector/BackEnd/saved_model.pkl')

test_mail ="INPUT STRING"
prediction = reg_from_joblib.predict(test_mail)
# input_data_features = feature_extraction.transform([input_your_mail])
# prediction = model.predict(input_data_features)
if prediction[0] == 1:
    print("Ham Mail")
else:
    print("Spam Mail")






# textToConvert = ""

# app = Flask(__name__)

# @app.route('/submit', methods=['GET', 'POST'])
# def upload():
#     # Check if the incoming POST is a file or text
#     if request.method == 'POST':
#         if 'file' in request.files:
#             file = request.files['file']
#             textToConvert = file.read()
#         else:
#             textToConvert = request.form['text']

#     # Call the ML model to check if the text is a phishing attempt
#     # If it is, return 'Phishing Attempt Detected!'
#     # If it is not, return 'Success!'

#     return 'Success!'