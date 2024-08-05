document.addEventListener("DOMContentLoaded", function() {
    updateDocType();
});

function updateDocType() {
    const department = document.getElementById('department').value;
    const doctype = document.getElementById('doctype');

    let options = [];

    switch (department) {
        case 'President':
            options = ['Payroll', 'Presidential Presence Request'];
            break;
        case 'Vice President Admin':
            options = [''];
            break;
        case 'Vice President Finance':
            options = [''];
            break;
        case 'VPAA Academic':
            options = [
                'Communication Letters', 
                'Academic concern, student affairs, and faculty.', 
                'Inside/Outside event Letter'
            ];
            break;
        case 'Human Resources':
            options = [
                'Hiring Evaluation', 
                'Promotion Evaluation ', 
                'Performance Evaluation', 
                'Memorandum', 
                'Conduct of Trainees', 
                'Attendance Monitoring Report'
            ];
            break;
        case 'Quality Assurance':
            options = ['Visitor, Student, Teacher Surveys', 'Alcuoca Documents'];
            break;
        case 'Guidance ':
            options = [''];
            break;
        case 'Office of Student Affairs':
            options = ['Student Violation', 'Good Moral'];
            break;
        case 'Registrar':
            options = ['Tor', 'Form 137'];
            break;
        case 'Faculties':
            options = [
                'Joint Memorandum',
                'Interoffice Memorandum',
                'Daily Time Record',
                'Activity Report',
                'Personal Data Sheet',
                'Letter of Request',
                'Letter to Inform',
                'Letter of Approval',
                'Faculty Training',
                'Needs Assesment Survey',
                'Letter of Invitation',
                'Memorandum Circular',
                'Letter of Endorsement',
                'Mock Interview Proposal',
                'Excuse Letter',
                'Administrative Order'
            ];
            break;
            default:
            options = [];
    }

    while (doctype.firstChild) {
        doctype.removeChild(doctype.firstChild);
    }

    options.forEach(option => {
        const opt = document.createElement('option');
        opt.value = option;
        opt.textContent = option;
        doctype.appendChild(opt);
    });

    console.log(`Updated document type options for ${department}:`, options);
}

document.addEventListener('DOMContentLoaded', () => {
    updateDocType();
});

document.getElementById('department').addEventListener('change', updateDocType);
