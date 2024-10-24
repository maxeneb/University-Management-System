document.addEventListener('DOMContentLoaded', function () {
function fetchColleges() {
    axios.get('process-students-college.php').then(function (response){
        displayColleges(response.data);

        document.getElementById('college').addEventListener('change', function() {
            selectedCollegeID = this.value;

            axios.get(`process-students-programs.php?collegeID=${selectedCollegeID}`).then(function (response){
                displayPrograms(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        });
    }).catch(function (error) {
        console.log(error);
    });
}

fetchColleges();

document.getElementById('studentForm').addEventListener('submit', function (event) {
    event.preventDefault();

    axios.post('process-students.php', {
        studID: document.getElementsByName('studID')[0].value,
        fName: document.getElementsByName('fName')[0].value,
        mName: document.getElementsByName('mName')[0].value,
        lName: document.getElementsByName('lName')[0].value,
        college: document.getElementsByName('college')[0].value,
        program: document.getElementsByName('program')[0].value,
        year: document.getElementsByName('year')[0].value,
        collegeID: selectedCollegeID, 
    }).then(function (response) {
        console.log(response.data);
        if (response.data.success) {
            alert(response.data.message);
        } else {
            alert('Failed to save student information. Please try again.');
        }
    }).catch(function (error) {
        console.log(error);
    });
});
});

const displayColleges = (data) => {
    let select = document.getElementById('college');
    data.forEach(dataElement => {
        let option = document.createElement('option');
        option.value = dataElement[0];
        option.innerText = dataElement[1];
        select.append(option);
    });
}

const displayPrograms = (data) => {
    let select = document.getElementById('program');
    select.innerHTML = "<option value='' selected>Select Program</option>";
    
    data.forEach(dataElement => {
        let option = document.createElement('option');
        option.value = dataElement[0];
        option.innerText = dataElement[1];
        select.append(option);
    });
}