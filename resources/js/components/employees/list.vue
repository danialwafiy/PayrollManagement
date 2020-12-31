<template>
<div class="container"  v-if="ready === true">
	<div class="row justify-content-center">
		<div class="col-12 pb-5">
            <div class="card border-muted rounded">
                <div class="card-header p-0">
                    <div class=" text-white text-center py-2" style="background-color:#2A3F54">
                        <p class="m-0 text-white">Employee List</p>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="m-0 text-muted" v-if="employeeList.length === 0">No Record.</p>
                    <div v-else>
                        <div class="row mb-3 mx-auto justify-content-center">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by First name" v-model="search_first_name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by Last name" v-model="search_last_name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by employee number" v-model="search_empNumber">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by department" v-model="search_department">
                            </div>
                        </div>
                        <table class="table table-hover rounded-lg tbl-responsive">
                            <thead>
                                <tr>
                                    <th>Emp ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Employee Number</th>
                                    <th>Contact</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Salary</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(employee,index) in filteredEmployee" :key="employee.id">
                                    <td>{{employee.id}}</td>
                                    <td>{{employee.firstname}}</td>
                                    <td>{{employee.lastname}}</td>
                                    <td>{{employee.employee_number}}</td>
                                    <td>{{employee.contact}}</td>
                                    <td>{{employee.department}}</td>
                                    <td>{{employee.position}}</td>
                                    <td>{{employee.basic_salary}}</td>
                                    <td class="text-center">
                                        <router-link :to="`/employees/${employee.id}`" class="text-primary"><i class="fas fa-edit"></i></router-link>
                                        <router-link :to="`/salary/new/${employee.id}`" class="text-success"><i class="fas fa-hand-holding-usd"></i></router-link>
                                        <a href="#" class="text-danger" @click="deleteEmployee(employee.id,index)"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0">
                    <router-link to="/employee/new"  class=" rounded p-2 text-white bgMainColor float-right">Register <i class="far fa-sticky-note"></i></router-link>
                </div>
            </div>
	    </div>
	</div>
</div>
</template>
<script>
    export default {
        data(){
            return{
                employeeList: null,
                ready:false,
                search_first_name:'',
                search_last_name:'',
                search_empNumber:'',
                search_department:''
            }
        },
        computed: {
            filteredEmployee: function(){
                return this.filterByDepartment(this.filterByEmpNumber(this.filterByFirstName(this.filterByLastName(this.employeeList))))
            }

/*             filteredEmployee() {
                return this.employeeList.filter(employee => {
                    return employee.firstname.toLowerCase().indexOf(this.search_name.toLowerCase()) > -1
                    || employee.lastname.toLowerCase().indexOf(this.search_name.toLowerCase()) > -1
                    || employee.employee_number.toLowerCase().indexOf(this.search_empNumber.toLowerCase()) > -1
                    || employee.department.toLowerCase().indexOf(this.search_department.toLowerCase()) > -1
                })
            } */
        },
        methods:{
            filterByDepartment: function(employees){
                return employees.filter(employee => !employee.department.indexOf(this.search_department))
            },
            filterByFirstName: function(employees){
                return employees.filter(employee => !employee.firstname.indexOf(this.search_first_name))
            },
            filterByLastName: function(employees){
                return employees.filter(employee => !employee.lastname.indexOf(this.search_last_name))
            },
            filterByEmpNumber: function(employees){
                return employees.filter(employee => !employee.employee_number.indexOf(this.search_empNumber))
            },
            
            getEmployees(){
                axios.get('/api/user')
                    .then((response) => {
                        console.log(response.data)
                        this.employeeList = response.data
                        this.ready = true
				});
            },
            deleteEmployee(id,index){
                swal.fire({
                    heightAuto: false,
                    title: 'Are you sure?',
                    text: "Delete this employee.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.value){
                            axios.delete('/api/user/'+id)
                            .then(() => {
                                this.employeeList.splice(index, 1)
                                swal.fire("Deleted!","Employee Deleted","warning");
                            }); 
                        }
                        else{

                        }
                })         
            }
        },
        created() {
            this.getEmployees();
            console.log(this.$gate.isAdmin())
        },

}
</script>

