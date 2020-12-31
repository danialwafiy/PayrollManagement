export default class Gate{

    constructor(laravel){
        if(laravel){
            this.user  = laravel.user;
            this.roles  = laravel.user.roles;
        }
    }

    isAdmin(){
        for(var i=0; i < this.roles.length; i++){
            if( this.roles[i]['name'] == 'admin'){
              return true;
            }
        }
        return false;
    }

}