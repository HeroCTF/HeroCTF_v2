from flask import Flask, render_template, request
from jinja2 import Environment


app = Flask(__name__)

@app.route('/')
def main():
	return render_template('upload.html')

@app.route('/uploader', methods=['POST'])
def upload_file():
	if request.method == 'POST':
		f = request.files['file']
		output = Environment().from_string(f.filename).render()
		return render_template('upload.html', filename=output)

if __name__ == '__main__':
	app.run(debug=False, host='0.0.0.0', port=4000)
