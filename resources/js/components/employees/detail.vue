<template>
<div class="container" id="printable">
        <div class="row col-md-12" v-if="isLoading" style="height:70vh">
            <RotateSquare2 class="mx-auto my-auto" background="#2A3F54" shadow="#cc0000"/>
        </div>
        <div v-else>
            <div class="col-md-12 p-3  text-center mx-auto justify-content-center">
                <div class=" border border-dark px-2 py-1 w-50 mx-auto" style="background-color:#c2c2c2">
                    <h4 class="font-weight-bold text-dark my-auto">Employee Details</h4>
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-6 mx-auto mt-4 text-center">
                <img class="img-fluid rounded w-75" :src="'/img/users/'+employee.picture" />
            </div>
            <fieldset :disabled="!this.$gate.isAdmin()">
            <form @submit.prevent="updateEmployee()">
                <table class="table table-bordered table-sm-responsive mb-0 mt-4">
                    <tr>
                        <td width="5%" class="text-right">1.</td>
                        <td class="font-weight-bold">Employee ID</td>
                        <td  colspan="10">{{employee.id}}</td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">2.</td>
                        <td class="font-weight-bold">Employee Number</td>
                        <td  colspan="10"><input type="text" class="w-100 border-0" v-model="employee.employee_number"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">3.</td>
                        <td  class="font-weight-bold">First Name</td> 
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.firstname" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">4.</td>
                        <td  class="font-weight-bold">Last Name</td> 
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.lastname"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">5.</td>
                        <td class="font-weight-bold">Address</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.address"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">6.</td>
                        <td class="font-weight-bold">IC Number</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.IC_number" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">7.</td>
                        <td class="font-weight-bold">Contact</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.contact"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">8.</td>
                        <td class="font-weight-bold">Email</td>
                        <td colspan="10"><input type="email" class="w-100 border-0" v-model="employee.email" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">9.</td>
                        <td class="font-weight-bold">Picture</td>
                        <td colspan="10"><input type="file" class="w-100 border-0" accept="image/png, image/jpeg" @change="onFileChange" name="picture"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">10.</td>
                        <td class="font-weight-bold">Username</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.name" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">11.</td>
                        <td class="font-weight-bold">Department</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.department" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">12.</td>
                        <td class="font-weight-bold">Basic Salary (RM)</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.basic_salary" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">13.</td>
                        <td class="font-weight-bold">Position</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.position" required></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">14.</td>
                        <td class="font-weight-bold">Date Start Work</td>
                        <td colspan="10"><input type="date" class="w-100 border-0" v-model="employee.date_start_work"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">15.</td>
                        <td class="font-weight-bold">Date Resign</td>
                        <td colspan="10"><input type="date" class="w-100 border-0" v-model="employee.date_resigned"></td>
                    </tr>
                    <tr>
                        <td width="5%" class="text-right">16.</td>
                        <td class="font-weight-bold">EPF Number</td>
                        <td colspan="10"><input type="text" class="w-100 border-0" v-model="employee.EPF_number"></td>
                    </tr>
                </table>
                <div class="row my-2" v-if="this.$gate.isAdmin()">
                    <div class="col-md-12 p-3 text-right">
                        <button class="btn btn-light float-left" type="button" @click="$router.back()"><i class="fas fa-long-arrow-alt-left"></i> Back</button>
                        <button class="btn btn-danger" type="button" @click="deleteEmployee()">Delete</button>
                        <button class="btn btn-secondary" type="button" @click="reset()">Cancel</button>
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
                isLoading:'',
                employee:'',
                picture:''
            }
        },
        methods:{
            onFileChange(e) {
                this.picture = e.target.files[0]
            },
            reset(){
                swal.fire({
                    title: 'Cancel any changes?',
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
            deleteEmployee(){
                swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this employee.",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.value){
                            axios.delete('/api/user/'+this.$route.params.id)
                            .then(() => {
                                swal.fire("Deleted!","Employee Deleted","warning");
                                this.$router.push('/employees')
                            }); 
                        }
                        else{

                        }
                }) 
            },
            updateEmployee(){
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                const form = new FormData
                if(this.picture != ''){
                    form.append('picture',this.picture)
                }
                form.append('employee',JSON.stringify(this.employee));
                form.append('_method','PATCH');
                axios.post('/api/user/'+this.$route.params.id,form,config).
                    then((res)=>{
                        swal.fire({
                            heightAuto: false,
                            title: 'Success',
                            text: "Employee updated.",
                            icon: 'success',
                        })
                        this.employee = res.data
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
            this.isLoading = true
            axios.get('/api/user/'+this.$route.params.id).then(res=>{
                this.employee = res.data
                this.original = res.data
                this.isLoading = false
            });
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
