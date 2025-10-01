<!DOCTYPE html>
<html lang="en">
<head>
    <title>Application Submitted - Cybersecurity Position</title>
</head>
<body>
    <h1>Cybersecurity Job Application - Summary</h1>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<h2>Application Details:</h2>";
        
        // 1. Full Name
        echo "<p><strong>Full Name:</strong> " . htmlspecialchars($_POST['name']) . "</p>";
        
        // 2. Programming Languages (multiple selection)
        echo "<p><strong>Programming Languages:</strong> ";
        if (isset($_POST['languages']) && is_array($_POST['languages'])) {
            echo implode(", ", $_POST['languages']);
        } else {
            echo "None selected";
        }
        echo "</p>";
        
        // 3. Security Tools Experience
        echo "<p><strong>Security Tools Experience:</strong><br>";
        echo nl2br(htmlspecialchars($_POST['tools']));
        echo "</p>";
        
        // 4. Years of Experience
        echo "<p><strong>Years of Experience:</strong> " . htmlspecialchars($_POST['experience']) . "</p>";
        
        // 5. Certifications
        echo "<p><strong>Cybersecurity Certifications:</strong><br>";
        echo nl2br(htmlspecialchars($_POST['certifications']));
        echo "</p>";
        
        // 6. Area of Specialization
        echo "<p><strong>Area of Specialization:</strong> " . htmlspecialchars($_POST['specialization']) . "</p>";
        
        echo "<hr>";
        echo "<p><em>Thank you for your application! We will review your information and contact you soon.</em></p>";
        
    } else {
        echo "<p>No data received. Please <a href='form.php'>fill out the form</a> first.</p>";
    }
    ?>
    
    <br>
    <a href="form.php">← Back to Form</a>
</body>
</html>
?>