from flask import Flask, request, jsonify

app = Flask(__name__)

@app.route('/contact.py', methods=['POST'])
def handle_contact():
    # Retrieve form data
    form_data = request.form

    # Example processing (can be customized based on requirements)
    name = form_data.get('name')
    email = form_data.get('email')
    message = form_data.get('message')

    if name and email and message:
        # Simulate success response
        return 'success'
    else:
        # If any form field is missing, return failure
        return 'failure'

if __name__ == '__main__':
    app.run(debug=True)
