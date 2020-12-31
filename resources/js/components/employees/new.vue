<template>
<div class="container">
        <div>
            <div class="col-md-12 p-3  text-center mx-auto justify-content-center">
                <div class=" border border-dark px-2 py-1 w-50 mx-auto" style="background-color:#c2c2c2">
                    <h4 class="font-weight-bold text-dark my-auto">Register Employee</h4>
                </div>
            </div>
            <form @submit.prevent="addEmployee()">
                <table class="table table-bordered table-sm-responsive mb-0 mt-4">
                    <tr>
                        <td width="5%" class="text-right">1.</td>
                        <td class="font-weight-bold">Employee Number</td>
                        <td  colspan="10"><input type="text" class="w-100 border-0" v-model="employee_number" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">2.</td>
                        <td  class="font-weight-bold">First Name</td> 
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="firstname" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">3.</td>
                        <td  class="font-weight-bold">Last Name</td> 
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="lastname" ></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">4.</td>
                        <td class="font-weight-bold">Address</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="address"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">5.</td>
                        <td class="font-weight-bold">IC Number</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="IC_number" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">6.</td>
                        <td class="font-weight-bold">Contact</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="contact"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">7.</td>
                        <td class="font-weight-bold">Email</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="email" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">8.</td>
                        <td class="font-weight-bold">Picture</td>
                        <td colspan="10"><input type="file" class="w-100 border-0" accept="image/png, image/jpeg" @change="onFileChange" name="picture"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">9.</td>
                        <td class="font-weight-bold">Username</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="name" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">10.</td>
                        <td class="font-weight-bold">Department</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="department" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">11.</td>
                        <td class="font-weight-bold">Basic Salary</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="basic_salary" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">12.</td>
                        <td class="font-weight-bold">Position</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="position" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">13.</td>
                        <td class="font-weight-bold">Date Start Work</td>
                        <td colspan="10"><input type="date" class="w-100 border-0" v-model="date_start_work"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">14.</td>
                        <td class="font-weight-bold">Date Resign</td>
                        <td colspan="10"><input type="date" class="w-100 border-0" v-model="date_resigned"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">15.</td>
                        <td class="font-weight-bold">EPF Number</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="EPF_number"></td>
                    </tr>
                </table>
                <div class="row my-2">
                    <div class="col-md-12 p-3 text-right">
                        <button class="btn btn-light float-left" type="button" @click="$router.back()"><i class="fas fa-long-arrow-alt-left"></i> Back</button>
                        <button class="btn btn-secondary" type="button" @click="reset()">Reset</button>
                        <button class="btn btn-primary" type="submit">Register</button>
                    </div>
                </div>
            </form>
        </div>
</div>
</template>

<script>
    export default {
        components: {
        },
        data(){
            return{
                employee_number:'',
                firstname:'',
                lastname:'',
                address:'',
                IC_number:'',
                contact:'',
                email:'',
                name:'',
                department:'',
                basic_salary:'',
                position:'',
                date_start_work:'',
                date_resigned:'',
                EPF_number:'',
                picture:''
            }
        },
        methods:{
            onFileChange(e) {
                this.picture = e.target.files[0]
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
            addEmployee(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const form = new FormData
                if(this.picture != ''){
                    form.append('picture',this.picture)
                }
                form.append('employee_number',this.employee_number);
                form.append('firstname',this.firstname);
                form.append('lastname',this.lastname);
                form.append('address',this.address);
                form.append('IC_number',this.IC_number);
                form.append('contact',this.contact);
                form.append('email',this.email);
                form.append('name',this.name);
                form.append('department',this.department);
                form.append('basic_salary',this.basic_salary);
                form.append('position',this.position);
                form.append('date_start_work',this.date_start_work);
                form.append('date_resigned',this.date_resigned);
                form.append('EPF_number',this.EPF_number);
                axios.post('/api/user',form,config).
                    then((res)=>{
                        swal.fire({
                            heightAuto: false,
                            title: 'Success',
                            text: "Employee registered.",
                            icon: 'success',
                        })
                        this.$router.push('/employees/'+res.data)
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
        computed:{

        },
        created(){

        },
        mounted() {

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
