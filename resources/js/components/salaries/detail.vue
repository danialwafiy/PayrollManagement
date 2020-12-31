<template>
<div class="container">
        <div class="row col-md-12" v-if="isLoading" style="height:70vh">
            <RotateSquare2 class="mx-auto my-auto" background="#2A3F54" shadow="#cc0000"/>
        </div>
        <div v-else>
            <fieldset :disabled="!this.$gate.isAdmin()">
            <form @submit.prevent="updateSalary()">
                <div class="col-md-12 p-3  text-center mx-auto justify-content-center">
                    <div class=" border border-dark px-2 py-1 w-50 mx-auto" style="background-color:#c2c2c2">
                        <h4 class="font-weight-bold text-dark my-auto">Salary Payment Details for {{salary.user.name}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-bordered table-sm-responsive mb-0 mt-4">
                            <tr>
                                <td width="5%" class="text-right">1.</td>
                                <td  class="font-weight-bold">First Name</td> 
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.user.firstname" disabled></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">2.</td>
                                <td  class="font-weight-bold">Employee Number Name</td> 
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.user.employee_number" disabled></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">3.</td>
                                <td class="font-weight-bold">Position</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.user.position" disabled></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">4.</td>
                                <td class="font-weight-bold">Month</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.month"></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">5.</td>
                                <td class="font-weight-bold">Year</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.year"></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">6.</td>
                                <td class="font-weight-bold">EPF Number</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.user.EPF_number" disabled></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">7.</td>
                                <td class="font-weight-bold">Paid Date</td>
                                <td colspan="10"><input type="date" class="w-100 border-0" v-model="salary.paid_date"></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">8.</td>
                                <td class="font-weight-bold">Basic Salary (RM)</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.user.basic_salary" disabled></td>
                            </tr>
                            <tr>
                                <td width="5%" class="text-right">9.</td>
                                <td class="font-weight-bold">Overtime (RM)</td>
                                <td colspan="10"><input type="text" class="w-100 border-0" v-model="salary.overtime"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 text-center my-auto">
                        <img class="img-fluid rounded w-75" :src="'/img/users/'+salary.user.picture" />
                    </div>
                </div>
                <div>
                    <h5 class="bgMainColor p-2 text-white mt-3">Allowances</h5>
                    <table class="table table-bordered table-sm-responsive">
                        <thead>
                            <tr>
                                <th scope="col" width="5%" class="text-center">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(allowance,index) in allowances" :key="'allowance'+index">
                                <td class="text-center">{{index+1}}</td>
                                <td><input type="text" v-model="allowance.description" class="w-100 border-0" required></td>
                                <td>
                                    <input type="text" v-model="allowance.amount" class="w-100 border-0" required>
                                    <span v-if="isAdmin" style="cursor:pointer" class="mt-2 badge badge-danger my-auto float-right" @click="deleteAllowance(index)"><i class="fas fa-trash p-1"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">RM{{totalAllowanceAmount}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class=" w-100" v-if="this.$gate.isAdmin()">
                        <button class="btn btn-primary text-right"  @click.prevent="addAllowance()">Add more</button>
                    </div>
                </div>
                <div>
                    <h5 class="bgMainColor p-2 text-white mt-3">Deduction</h5>
                    <table class="table table-bordered table-sm-responsive">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" width="5%">#</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(deduction,index) in deductions" :key="'deduction'+index">
                                <td class="text-center">{{index+1}}</td>
                                <td><input type="text" v-model="deduction.description" class="w-100 border-0" required></td>
                                <td>
                                    <input type="text" v-model="deduction.amount" class="w-100 border-0" required>
                                    <span v-if="isAdmin" style="cursor:pointer" class="mt-2 badge badge-danger my-auto float-right" @click="deleteDeduction(index)"><i class="fas fa-trash p-1"></i></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-right font-weight-bold">RM{{totalDeductionAmount}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class=" w-100" v-if="this.$gate.isAdmin()">
                        <button class="btn btn-primary text-right"  @click.prevent="addDeduction()">Add more</button>
                    </div>
                </div>
                <h5 class="bgMainColor p-2 text-white mt-3">Net Pay (RM) <span class="float-right">{{netPay}}</span></h5>
                <div class="row my-2" v-if="this.$gate.isAdmin()">
                    <div class="col-md-12 p-3 text-right">
                        <button class="btn btn-light float-left" type="button" @click="$router.back()"><i class="fas fa-long-arrow-alt-left"></i> Back</button>
                        <button class="btn btn-danger" type="button" @click="deleteSalary()">Delete</button>
                        <button class="btn btn-secondary" type="button" @click="reset()">Reset</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </div>
            </form>
            </fieldset>
        </div>
</div>
</template>

<script>
    import {RotateSquare2} from 'vue-loading-spinner'

    export default {
        components: {
            RotateSquare2
        },
        data(){
            return{
                salary:'',
                employee:'',
                allowances:[],
                deductions:[],
                isLoading:true,
                isAdmin:''
            }
        },
        computed:{
            totalAllowanceAmount(){
                var sum = 0;
                this.allowances.forEach(e => {
                    var x = parseFloat(e.amount)
                    sum = sum + x
                });
                return sum.toFixed(2)
            },
            totalDeductionAmount(){
                var sum = 0;
                this.deductions.forEach(e => {
                    var x = parseFloat(e.amount)
                    sum = sum + x
                });
                return sum.toFixed(2)
            },
            netPay(){
                var basic = this.salary.user.basic_salary
                var sum = parseFloat(basic) + parseFloat(this.totalAllowanceAmount) + parseFloat(this.salary.overtime)- parseFloat(this.totalDeductionAmount)
                return sum.toFixed(2)
            }
        },
        methods:{
            deleteSalary(){
                swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this salary.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.value){
                            axios.delete('/api/salary/'+this.$route.params.id)
                            .then(() => {
                                swal.fire("Deleted!","Salary Deleted","warning");
                                this.$router.push('/salaries')
                            }); 
                        }
                        else{

                        }
                }) 
            },
            getEmployee(){
                axios.get('/api/user/'+this.$route.params.id).then(res=>{
                    this.employee = res.data
                    this.isLoading = false
                });
            },
            addAllowance(){
                this.allowances.push({
                    description:'',
                    amount:'',
                });
            },
            deleteAllowance(index){
                this.allowances.splice(index,1)  
            },
            addDeduction(){
                this.deductions.push({
                    description:'',
                    amount:'',
                });
            },
            deleteDeduction(index){
                this.deductions.splice(index,1)  
            },
            reset(){
                swal.fire({
                    title: 'Reset form',
                    text: "Data will be lost",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.value){
                            this.$router.go() 
                        }
                    }) 
            },
            updateSalary(){
                const form = new FormData
                form.append('year',this.salary.year);
                form.append('month',this.salary.month);
                form.append('amount_paid',this.netPay);
                form.append('paid_date',this.salary.paid_date);
                form.append('total_allowance',this.totalAllowanceAmount);
                form.append('total_deduction',this.totalDeductionAmount);
                form.append('overtime',this.salary.overtime);

                form.append('allowances',JSON.stringify(this.allowances));

                form.append('deductions',JSON.stringify(this.deductions));

                form.append('_method','PATCH');
                axios.post('/api/salary/'+this.$route.params.id,form).
                    then((res)=>{
                        swal.fire({
                            heightAuto: false,
                            title: 'Success',
                            text: "Salary updated.",
                            icon: 'success',
                        })
                        this.salary = res.data
                        this.deductions = res.data.deduction
                        this.allowances = res.data.allowance
                    })
                    .catch((e)=>{
                        swal.fire({
                            heightAuto: false,
                            title: 'Failed',
                            text: e.response.data.message,
                            icon: 'error',
                        })
                    });
            },
        },
        created(){

        },
        mounted() {
            this.isLoading = true
            axios.get('/api/salary/'+this.$route.params.id).then(res=>{
                this.salary = res.data
                this.deductions = res.data.deduction
                this.allowances = res.data.allowance
                this.isLoading = false
            });
            this.isAdmin = this.$gate.isAdmin()
        }
    }
</script>

<style scoped>
.table th, .table td {
    padding: 5px;
}
.table-bordered th, .table-bordered td {
    border: 1px solid black ;
}
label{
    font-weight:bold
}
textarea:focus, input:focus{
    outline: none;
}
</style>
