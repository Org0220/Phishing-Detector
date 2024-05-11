from sklearn.feature_extraction.text import TfidfVectorizer
from flask import Flask, request
from joblib import Parallel, delayed 
import joblib

# Load the model
reg_from_joblib = joblib.load('./BackEnd/saved_model.pkl')

# Load the vectorizer
feature_extraction = joblib.load('./BackEnd/feature_extraction.pkl')

#predict function
def predict(text,model):
    cw = feature_extraction.transform([text])
    result = model.predict(cw)
    if result[0] == 1:
        print("Ham Mail")
    else:
        print("Spam Mail")

# test string
test_mail = "Hey John, how r u? I was wondering what the status of the proeject is."

predict(test_mail, reg_from_joblib)

# prediction = reg_from_joblib.predict(test_mail)
# input_data_features = feature_extraction.transform([test_mail])
# prediction = reg_from_joblib.predict(input_data_features)

# if prediction[0] == 1:
#     print("Ham Mail")
# else:
#     print("Spam Mail")






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