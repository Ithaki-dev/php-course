<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cybersecurity Job Application</title>
</head>
<body>
    <h1>Cybersecurity Specialist</h1>
    
    <form action="print.php" method="post">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" placeholder="Your full name" required>
        </div>

        <div class="form-group">
            <label for="languages">Programming Languages (select all that apply):</label>
            <select name="languages[]" multiple size="6">
                <option value="Python">Python</option>
                <option value="JavaScript">JavaScript</option>
                <option value="Java">Java</option>
                <option value="C++">C++</option>
                <option value="PowerShell">PowerShell</option>
                <option value="Bash">Bash/Shell Scripting</option>
                <option value="SQL">SQL</option>
                <option value="PHP">PHP</option>
            </select>
            <br><small>Hold Ctrl/Cmd to select multiple options</small>
        </div>

        <div class="form-group">
            <label for="tools">Security Tools Experience:</label>
            <textarea name="tools" rows="4" cols="50" placeholder="List security tools you have experience with (e.g., Wireshark, Nmap, Metasploit, Burp Suite, etc.)"></textarea>
        </div>

        <div class="form-group">
            <label for="experience">Years of Experience in Cybersecurity:</label>
            <select name="experience" required>
                <option value="">Select experience level</option>
                <option value="0-1">0-1 years (Entry level)</option>
                <option value="2-3">2-3 years (Junior)</option>
                <option value="4-5">4-5 years (Mid-level)</option>
                <option value="6-10">6-10 years (Senior)</option>
                <option value="10+">10+ years (Expert/Lead)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="certifications">Cybersecurity Certifications:</label>
            <textarea name="certifications" rows="3" cols="50" placeholder="List your certifications (e.g., CISSP, CEH, CISM, CompTIA Security+, etc.)"></textarea>
        </div>

        <div class="form-group">
            <label for="specialization">Area of Specialization:</label>
            <select name="specialization" required>
                <option value="">Select your main area</option>
                <option value="penetration-testing">Penetration Testing</option>
                <option value="incident-response">Incident Response</option>
                <option value="network-security">Network Security</option>
                <option value="application-security">Application Security</option>
                <option value="cloud-security">Cloud Security</option>
                <option value="compliance">Compliance & Risk Management</option>
                <option value="forensics">Digital Forensics</option>
                <option value="threat-intelligence">Threat Intelligence</option>
            </select>
        </div>

        <button type="submit">Submit Application</button>
    </form>
</body>
</html>
