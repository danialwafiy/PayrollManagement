<template>
<div class="container">
   <aside class="profile-card">
       <div class="container p-5 my-auto text-center text-white ">
           <h1 class="font-weight-bold">Payroll Management System</h1>
           <div class="mt-3 font-weight-bold">- ABC Company Sdn Bhd -</div>
       </div>
    </aside>
</div>
</template>
<style>
.profile-card {
  background: #2A3F54;
  width: 56px;
  height: 56px;
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 2;
  overflow: hidden;
  opacity: 0;
  -webkit-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  -webkit-border-radius: 50%;
  border-radius: 50%;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
  animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, 
             moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, 
             moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, 
             materia 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
}


@keyframes init {
  0% {
    width: 0px;
    height: 0px;
  }
  100% {
    width: 56px;
    height: 56px;
    margin-top: 0px;
    opacity: 1;
  }
}

@keyframes moveDown {
  0% {
    top: 50%;
  }
  50% {
    top: 40%;
  }
  100% {
    top: 100%;
  }
}

@keyframes moveUp {
  0% {
    background: #2A3F54;
    top: 100%;
  }
  50% {
    top: 40%;
  }
  100% {
    top: 50%;
    background: #E0E0E0;
  }
}

@keyframes materia {
  0% {
    background: #E0E0E0;
  }
  50% {
    border-radius: 4px;
  }
  100% {
    width: 800px;
    height: 200px;
    background: #2A3F54;
    border-radius: 4px;
  }
}

</style>