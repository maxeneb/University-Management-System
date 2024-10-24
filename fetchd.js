document.addEventListener('DOMContentLoaded', function () {
    let selectedCollegeID; 

    function fetchColleges() {
        axios.get('process-students-college.php')
            .then(function (response) {
                displayColleges(response.data);

                selectedCollegeID = response.data[0][0]; 
                fetchDepartments(selectedCollegeID);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function fetchDepartments(collegeID) {
        axios.get(`process-departments.php?collegeID=${collegeID}`)
            .then(function (response) {
                displayDepartments(response.data);
            })
            .catch(function (error) {
                console.log(error);
            });
    }

    function updateDepartments() {
        fetchDepartments(selectedCollegeID);
    }

    fetchColleges();

    let collegeSelect = document.getElementById('college');
    collegeSelect.addEventListener('change', function () {
        selectedCollegeID = this.value;

        updateDepartments();
    });
});

const displayColleges = (data) => {
    let select = document.getElementById('college');
    select.innerHTML = "<option value='' selected>Select College</option>";

    data.forEach(dataElement => {
        let option = document.createElement('option');
        option.value = dataElement[0];
        option.innerText = dataElement[1];
        select.append(option);
    });
};

const displayDepartments = (data) => {
    let select = document.getElementById('department');
    select.innerHTML = "<option value='' selected>Select Department</option>";

    data.forEach(dataElement => {
        let option = document.createElement('option');
        option.value = dataElement.deptid;
        option.innerText = dataElement.deptfullname;
        select.append(option);
    });
};
