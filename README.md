# skill-verification
To verify skills in live
# Live Skill Verification Resume System (LVSR)

A comprehensive full-stack web application for evaluating programming skills and generating verified skill-based resumes.

## Features

### User Features
- **Complete Registration System**: Personal details, education, internships, work experience, and achievements
- **Skill Assessment Tests**: Multiple programming languages (C, Java, Python)
- **Cognitive Skills Evaluation**: Problem-solving and decision-making assessments
- **Anti-Cheating System**: Tab switching detection and automatic submission
- **Real-time Exam Interface**: Question navigation, timer, progress tracking
- **Instant Results**: Detailed score breakdown and analytics
- **Verified Certificates**: Auto-generated certificates for scores ≥70%
- **Skill Badges**: Earn badges for verified skills
- **Resume Generation**: Professional resume with verified skills
- **LinkedIn Sharing**: Direct sharing to LinkedIn
- **Progress Tracking**: Multiple attempt analysis and improvement tracking

### Admin Features
- **Admin Dashboard**: System statistics and overview
- **Question Management**: Add, edit, delete questions
- **User Management**: View and manage registered users
- **Result Analytics**: Comprehensive result analysis
- **Certificate Management**: View issued certificates
- **System Settings**: Configure exam parameters

## Technology Stack

### Frontend
- **HTML5**: Semantic markup and structure
- **CSS3**: Modern styling with animations and responsive design
- **JavaScript**: Interactive features and AJAX functionality
- **No external frameworks**: Pure vanilla JavaScript implementation

### Backend
- **PHP**: Server-side logic and database operations
- **MySQL**: Database management and data storage
- **Session Management**: Secure user authentication
- **Prepared Statements**: SQL injection prevention

### Database
- **MySQL**: Relational database with proper relationships
- **10+ Tables**: Comprehensive data structure
- **Optimized Queries**: Efficient data retrieval and processing

## Project Structure

```
LSVR_Project/
├── index.html                 # Home page
├── login.html                 # User login
├── register.html              # User registration
├── dashboard.html             # User dashboard
├── exam.html                  # Exam interface
├── result.html                # Results page
├── resume.html                # Resume generation
├── css/
│   └── style.css              # Main stylesheet
├── js/
│   ├── login.js               # Login functionality
│   ├── register.js            # Registration functionality
│   ├── exam.js                # Exam interface logic
│   ├── timer.js               # Timer functionality
│   └── navigation.js          # Navigation logic
├── php/
│   ├── config.php             # Database configuration
│   ├── register.php           # Registration processing
│   ├── login.php              # Login processing
│   ├── fetch_questions.php    # Question retrieval
│   ├── submit_exam.php        # Exam submission
│   ├── get_results.php        # Results retrieval
│   ├── generate_resume.php    # Resume generation
│   ├── certificate.php        # Certificate generation
│   ├── get_dashboard_data.php # Dashboard data
│   └── logout.php             # Logout functionality
├── admin/
│   ├── admin_login.php        # Admin login
│   ├── admin_dashboard.php    # Admin dashboard
│   ├── admin_login_process.php # Admin login processing
│   ├── admin_logout.php       # Admin logout
│   ├── add_questions.php      # Add questions interface
│   ├── add_question_process.php # Question processing
│   ├── get_admin_stats.php    # Admin statistics
│   ├── edit_questions.php     # Edit questions
│   ├── manage_users.php       # User management
│   ├── view_results.php       # View results
│   ├── manage_certificates.php # Certificate management
│   └── system_settings.php    # System settings
└── database/
    └── lsvr_database.sql      # Database schema
```

## Database Schema

### Main Tables
1. **users**: User registration data
2. **education**: Educational qualifications
3. **internships**: Internship experiences
4. **experience**: Work experience
5. **achievements**: User achievements
6. **questions**: Question bank
7. **attempts**: Exam attempts
8. **answers**: User answers
9. **results**: Test results
10. **certificates**: Generated certificates
11. **badges**: Earned badges
12. **admin**: Administrator accounts

## Installation Instructions

### Prerequisites
- XAMPP/WAMP/MAMP (or similar web server with PHP and MySQL)
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Modern web browser

### Setup Steps

1. **Download and Extract**
   - Extract the project files to your web server's root directory (usually `htdocs` for XAMPP)

2. **Database Setup**
   - Start Apache and MySQL from XAMPP control panel
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Import the database file: `database/lsvr_database.sql`
   - Verify that the database `lsvr_database` is created with all tables

3. **Configuration**
   - The database configuration is already set up in `php/config.php`
   - Default settings:
     - Host: localhost
     - Username: root
     - Password: (empty)
     - Database: lsvr_database

4. **Admin Access**
   - Default admin credentials:
     - Username: admin
     - Password: admin123
   - Access admin panel: http://localhost/skill-verification/admin/admin_login.php

5. **Start Using**
   - Open your browser and navigate to: http://localhost/skill-verification/
   - Register as a new user or login with existing credentials
   - Admins can access the admin panel for system management

## Usage Guide

### For Users

1. **Registration**
   - Fill in complete personal, educational, and professional information
   - Add multiple internships, experiences, and achievements
   - All data is stored for resume generation

2. **Taking Tests**
   - Select one or more programming languages
   - Complete the exam within the time limit
   - Answer MCQs, cognitive questions, and coding challenges
   - Submit the exam to view results

3. **Viewing Results**
   - Get detailed score breakdown for technical and cognitive skills
   - Track improvement across multiple attempts
   - Earn certificates and badges for high scores

4. **Resume Generation**
   - Automatic resume generation with verified skills
   - Download as PDF or share on LinkedIn
   - Professional format with all achievements

### For Administrators

1. **Dashboard**
   - View system statistics and recent activity
   - Monitor user engagement and test performance

2. **Question Management**
   - Add new questions for different languages and skill categories
   - Edit existing questions and answers
   - Organize questions by difficulty level

3. **User Management**
   - View registered users and their activity
   - Monitor test attempts and results
   - Manage user accounts if needed

4. **System Settings**
   - Configure exam parameters
   - Manage certificate templates
   - Update system settings

## Security Features

- **Password Hashing**: All passwords are securely hashed using PHP's password_hash()
- **SQL Injection Prevention**: All database queries use prepared statements
- **Session Management**: Secure session handling with proper timeout
- **Input Validation**: All user inputs are sanitized and validated
- **Anti-Cheating**: Tab switching detection and automatic submission
- **Access Control**: Role-based access for users and administrators

## Exam Features

### Question Types
- **Multiple Choice Questions (MCQ)**: Technical knowledge assessment
- **Coding Questions**: Programming problem-solving with code editor
- **Cognitive Questions**: Problem-solving and decision-making scenarios

### Exam Interface
- **Timer**: Countdown timer with automatic submission
- **Question Navigation**: Easy navigation between questions
- **Status Indicators**: Visual indicators for answered, skipped, and marked questions
- **Code Editor**: Built-in code editor for programming questions
- **Progress Tracking**: Real-time progress updates

### Anti-Cheating Measures
- **Tab Switching Detection**: Warns users when switching tabs
- **Window Focus Loss**: Detects when user leaves the exam window
- **Automatic Submission**: Submits exam after multiple warnings
- **Copy/Paste Prevention**: Disables copy/paste during exam
- **Right-Click Prevention**: Disables context menu during exam

## Certificate System

### Automatic Generation
- Certificates generated for scores ≥70%
- Unique verification ID for each certificate
- Professional design with user details
- Downloadable PDF format

### Verification
- Each certificate has a unique verification ID
- Verification system for employers
- Secure certificate validation

## Resume Features

### Professional Format
- Clean, modern resume design
- Complete personal and professional information
- Verified skills with scores
- Achievements and certifications
- Professional layout suitable for printing

### LinkedIn Integration
- Direct sharing to LinkedIn
- Pre-formatted share message
- Skill verification summary
- One-click sharing functionality

## Browser Compatibility

- Google Chrome (Recommended)
- Mozilla Firefox
- Microsoft Edge
- Safari

## Mobile Responsiveness

The system is fully responsive and works on:
- Desktop computers
- Laptops
- Tablets
- Mobile devices

## Performance Optimization

- Efficient database queries
- Minimal external dependencies
- Optimized CSS and JavaScript
- Fast page loading times
- Responsive image handling

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Ensure MySQL is running in XAMPP
   - Check database credentials in `php/config.php`
   - Verify database import was successful

2. **Session Issues**
   - Ensure PHP session path is writable
   - Check browser cookie settings
   - Clear browser cache if needed

3. **File Upload Issues**
   - Check folder permissions for uploads/
   - Ensure PHP file upload is enabled
   - Verify upload limits in php.ini

4. **Email Functionality**
   - Configure SMTP settings if needed
   - Check firewall settings
   - Verify email configuration

### Error Messages

- **"Unauthorized access"**: Please login first
- **"Database connection failed"**: Check database configuration
- **"No questions available"**: Add questions via admin panel
- **"Certificate not found"**: Verify certificate ID and user permissions

## Support

For technical support or questions:
1. Check this README file
2. Verify installation steps
3. Check error logs in XAMPP
4. Ensure all prerequisites are met

## License

This project is for educational and demonstration purposes. Please use responsibly and in accordance with applicable laws and regulations.

## Future Enhancements

Potential improvements for future versions:
- More programming languages support
- Advanced code execution system
- Video interview integration
- Employer portal for job matching
- Advanced analytics dashboard
- Mobile app development
- Integration with professional networks
- AI-powered question generation
- Real-time collaboration features

---

**Note**: This system is designed as a complete educational project demonstrating full-stack web development capabilities. All features are implemented without third-party APIs or external services as specified.
