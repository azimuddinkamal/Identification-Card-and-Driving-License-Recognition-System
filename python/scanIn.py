import requests

url = 'https://app.nanonets.com/api/v2/OCR/Model/6a4b53e8-a7c1-4d25-ae60-196b77d89fed/LabelFile/'

data = {'file': open('C://xampp//htdocs//fyp//load//2.jpg', 'rb')}

response = requests.post(url, auth=requests.auth.HTTPBasicAuth('LUAD09AU177Ic51IOAFmk7Ro1gwEXIzd', ''), files=data)

f = open('C://xampp//htdocs//fyp//json//info.json',"w")

f.write (response.text)
print(response.text)