import os
from sklearn.feature_extraction.text import TfidfVectorizer
from flask import Flask, request, jsonify
from joblib import Parallel, delayed 
import joblib

current_dir = os.path.dirname(__file__)

# Load the model and vectorizer
feature_extraction = joblib.load(current_dir + '/feature_extraction.pkl')
reg_from_joblib = joblib.load(current_dir + '/saved_model.pkl')

app = Flask(__name__)
@app.route('/submit', methods=['GET', 'POST'])

def receive_data():
    email = request.form.get('emailContent')
    # Example computation: Create a greeting message
    response_message = predict(email, reg_from_joblib)
    return jsonify({'message': response_message})

def predict(text,model):
    prediction_text = feature_extraction.transform([text])
    result = model.predict(prediction_text)
    if result[0] == 1:
        return "Ham"
    else:
        return "Spam"

if __name__ == '__main__':
    app.run()