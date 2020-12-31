<template>
<div class="container"  v-if="ready === true">
	<div class="row justify-content-center">
		<div class="col-12 pb-5">
            <div class="card border-muted rounded">
                <div class="card-header p-0">
                    <div class=" text-white text-center py-2" style="background-color:#2A3F54">
                        <p class="m-0 text-white">Salary Payment</p>
                    </div>
                </div>
                <div class="card-body p-3">
                    <p class="m-0 text-muted" v-if="salaryList.length === 0">No Record.</p>
                    <div v-else>
                        <div class="row mb-3 mx-auto justify-content-center" v-if="this.$gate.isAdmin()">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by First name" v-model="search_first_name">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by employee number" v-model="search_empNumber">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by month" v-model="search_month">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Filter by year" v-model="search_year">
                            </div>
                        </div>
                        <table class="table table-hover rounded-lg tbl-responsive" v-if="this.$gate.isAdmin()">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emp Number</th>
                                    <th>First Name</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Paid Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(salary,index) in filteredSalaries" :key="salary.id">
                                    <td>{{index+1}}</td>
                                    <td>{{salary.user.employee_number}}</td>
                                    <td>{{salary.user.firstname}}</td>
                                    <td>{{salary.year}}</td>
                                    <td>{{salary.month}}</td>
                                    <td>{{salary.amount_paid}}</td>
                                    <td>{{salary.paid_date | formatDate}}</td>
                                    <td class="text-center">
                                        <router-link :to="`/salaries/${salary.id}`" class="text-primary"><i class="fas fa-edit"></i></router-link>
                                        <a href="#" class="text-danger" @click="deleteSalary(salary.id,index)"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-hover rounded-lg tbl-responsive" v-else>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Emp Number</th>
                                    <th>First Name</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Amount</th>
                                    <th>Paid Date</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(salary,index) in filteredUser" :key="salary.id">
                                    <td>{{index+1}}</td>
                                    <td>{{salary.user.employee_number}}</td>
                                    <td>{{salary.user.firstname}}</td>
                                    <td>{{salary.year}}</td>
                                    <td>{{salary.month}}</td>
                                    <td>{{salary.amount_paid}}</td>
                                    <td>{{salary.paid_date | formatDate}}</td>
                                    <td class="text-center">
                                        <router-link :to="`/salaries/${salary.id}`" class="text-primary"><i class="fas fa-eye"></i></router-link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                salaryList: null,
                ready:false,
                search_first_name:'',
                search_month:'',
                search_empNumber:'',
                search_year:''
            }
        },
        computed: {
            filteredSalaries: function(){
                return this.filterByMonth(this.filterByEmpNumber(this.filterByFirstName(this.filterByYear(this.salaryList))))
            },
            filteredUser: function(){
                return this.salaryList.filter(salary => {
                    return salary.user.id.toString().toLowerCase().indexOf(this.$gate.user.id.toString().toLowerCase()) > -1
                })            
            }
        },
        methods:{
            filterByMonth: function(salaries){
                return salaries.filter(salary => !salary.month.indexOf(this.search_month))
            },
            filterByYear: function(salaries){
                return salaries.filter(salary => !salary.year.indexOf(this.search_year))
            },
            filterByFirstName: function(salaries){
                return salaries.filter(salary => !salary.user.firstname.indexOf(this.search_first_name))
            },
            filterByEmpNumber: function(salaries){
                return salaries.filter(salary => !salary.user.employee_number.indexOf(this.search_empNumber))
            },
            getSalaries(){
                axios.get('/api/salary')
                    .then((response) => {
                        this.salaryList = response.data
                        this.ready = true
				});
            },
            deleteSalary(id,index){
                swal.fire({
                    heightAuto: false,
                    title: 'Are you sure?',
                    text: "Delete this salary.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.value){
                            axios.delete('/api/salary/'+id)
                            .then(() => {
                                this.salaryList.splice(index, 1)
                                swal.fire("Deleted!","Salary Deleted","warning");
                            }); 
                        }
                        else{

                        }
                })         
            }
        },
        created() {
            this.getSalaries();
        },

}
</script>

