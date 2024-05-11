import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score, confusion_matrix
from sklearn.metrics import classification_report

# Load the dataset
dataset1 = pd.read_csv('./BackEnd/mail_data_1.csv', encoding='latin-1')
dataset2 = pd.read_csv('./BackEnd/mail_data_2.csv', encoding='latin-1')

# Drop unnecessary columns in dataset2
dataset2.drop(['Index', 'LabelNum'], axis=1, inplace=True)

# Display the first few rows of each dataset
# print(dataset1.head())
# print(dataset2.head())

# Concatenate the two datasets
dataset = pd.concat([dataset1, dataset2], ignore_index=True, sort=False)

# Display the first few rows of the concatenated dataset
# print(dataset.head())

# Convert 'spam' and 'ham' to binary labels
dataset['Category'] = dataset['Category'].map({'spam': 0, 'ham': 1})

# Split the data into features (X) and target (Y)
X = dataset["Message"]
Y = dataset["Category"]

# Split the data into training and test sets
# Set test_size to desired percentage 0.0001
X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size=0.0001, random_state=3)

# TF-IDF feature extraction
feature_extraction = TfidfVectorizer(min_df=1, stop_words='english', lowercase=True)
X_train_features = feature_extraction.fit_transform(X_train)
X_test_features = feature_extraction.transform(X_test)

Y_train = Y_train.astype(int)
Y_test = Y_test.astype(int)

# Model training
model = LogisticRegression()
model.fit(X_train_features, Y_train)

# Model evaluation
prediction_on_training_data = model.predict(X_train_features)
accuracy_on_training_data = accuracy_score(Y_train, prediction_on_training_data)

prediction_on_test_data = model.predict(X_test_features)
accuracy_on_test_data = accuracy_score(Y_test, prediction_on_test_data)

# Print accuracy
# print('Accuracy on training data: {} %'.format(accuracy_on_training_data * 100))
# print('Accuracy on test data: {} %'.format(accuracy_on_test_data * 100))

# Confusion Matrix Visualization
# conf_matrix = confusion_matrix(Y_test, prediction_on_test_data)
# plt.figure(figsize=(8, 6))
# sns.heatmap(conf_matrix, annot=True, fmt="d", cmap="Blues", cbar=False,
#             xticklabels=['Spam', 'Ham'], yticklabels=['Spam', 'Ham'])
# plt.xlabel('Predicted')
# plt.ylabel('Actual')
# plt.title('Confusion Matrix')
# plt.show()

# Classification report
# classification_rep = classification_report(Y_test, prediction_on_test_data,target_names=['Spam', 'Ham'])
# print("Classification Report:")
# print(classification_rep)

# Metrics calculation
# TP = conf_matrix[1, 1]
# TN = conf_matrix[0, 0]
# FP = conf_matrix[0, 1]
# FN = conf_matrix[1, 0]

# accuracy = (TP + TN) / (TP + TN + FP + FN)
# precision = TP / (TP + FP)
# recall = TP / (TP + FN)
# specificity = TN / (TN + FP)

# print("Accuracy : ",accuracy)
# print("Precision : ",precision)
# print("Recall : ",recall)
# print("Specificity : ",specificity)

input_your_mail ="INPUT STRING"
input_data_features = feature_extraction.transform([input_your_mail])
prediction = model.predict(input_data_features)
if prediction[0] == 1:
    print("Ham Mail")
else:
    print("Spam Mail")