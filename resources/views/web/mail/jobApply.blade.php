<!DOCTYPE html>
<html>

<head>
    <title>Job Apply Mail</title>
</head>

<body>

    <h1>New application for the post {{ $details['post_title'] }}</h1>
    <p>Name: {{ $details['name'] }}</p>
    <p>Father's name: {{ $details['father_name'] }}</p>
    <p>Mother's name: {{ $details['mother_name'] }}</p>
    <p>Email: {{ $details['email'] }}</p>
    <p>Phone: {{ $details['phone'] }}</p>
    <p>DOB: {{ $details['dob'] }}</p>
    <p>Educational Qualification: {{ $details['education_qualification'] }}</p>
    <p>Work Experience: {{ $details['work_experience'] }}</p>
    <p>Marital Status: {{ $details['marital_status'] }}</p>
    <p>Address: {{ $details['address'] }}</p>
    <p>Pin code: {{ $details['pin'] }}</p>

</body>

</html>
