<template>
  <div class="login_layout">
    <img src="../../uploads/images/pgfood.png">
    <div class="center" >
    <h1>Đăng nhập</h1>
    <form action="" @submit.prevent="login">
      <div class="txt_field">
        <input type="text" v-model="form.email" @blur="validate()">
        <span></span>
        <label>Email</label>
      </div>
      <div class="feedback_validation">{{ errors.email }}</div>
      <div class="txt_field">
        <input type="password" v-model="form.password" @blur="validate()" class="is-invalid">
        <span></span>
        <label>Password</label>
      </div>
      <div class="feedback_validation">{{ errors.password }}</div>

      <!-- <div class="pass">
        Forgot Password ?
      </div> -->
      <input type="submit" name="" id="" value="Đăng nhập">
      <div class="signup_link">Bạn chưa có tài khoản ?<router-link to="/register"> Đăng ký</router-link></div>
    </form> 
  </div>
  </div>
  
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      errors:{
        email:'',
        password:'',
      },
      form: {
        email: '',
        password:''
      },
    }
  },
  computed:{
    ...mapGetters({
      accountInfo : "auth/account"
    })
  },
  methods: {
    validate(){
      let isValid = true;
      if(!this.form.email){
        this.errors.email = "Email is required"
        isValid = false;
      }

      if(!this.form.password){
        this.errors.password = "Password is required"
        isValid = false;

      }
      return isValid

    },
    async login() {
      if(this.validate()){
        await this.$store.dispatch('auth/login', this.form)
        .then(() => {
          const check_role = this.accountInfo.is_admin;
          if(check_role === 1)
          {  
            this.$router.push({path: "/categories"}).then((response) => {
              this.$toast.success('Đăng nhập thành công !');
            });
            
          }
          else
          {   
            this.$router.push({path: "/home-page"});
            this.$toast.success('Đăng nhập thành công!');

          }
        })
        .catch((error) => {
         
          this.$toast.error('Đăng nhập không thành công! Vui lòng kiểm tra lại thông tin đăng nhập');
        });
      }
      
    },
  }
}
</script>

<style lang="scss" scoped>
.login_layout{
  margin:0;
  padding:0;
  font-family: montserrat;
  background: rgba(0, 0, 0,0.6);
  height: 100vh;
  overflow: hidden;
  img{
    width: 100%;
    height: 100vh;
    opacity: 0.4;
  }
}
.center{
  position:absolute;
  top:50%;
  left:50%;
  transform: translate(-50%,-50%);
  width: 400px;
  background: white;
  border-radius:10px ;
  h1{
    text-align: center;
    padding:20px 0 20px 0;
  }  
  form{
    padding:0 40px;
    box-sizing: border-box;
    .txt_field{
      position: relative;
      border-bottom: 2px solid #adadad;
      margin: 30px 0 10px 0;
      input{
        width:100%;
        padding:0 5px;
        height: 40px;
        font-size:16px;
        border:none;
        background: none;
        outline: none;
      }
      label{
        position: absolute;
        top:50%;
        left:5px;
        color:#989696;
        transform: translateY(-50%);
        font-size:16px;
        pointer-events:none;
        transition: .5s;
      }
      span::before{
        content:'';
        position: absolute;
        top:40px;
        left:0;
        width:0%;
        height: 2px;
        background: #2691d9;
        transition:0.5s;
      }
    }
    
  }
  .pass{
    margin : -5xp 0 20px 5px;
    color: #a6a6a6;
    cursor: pointer;
  }
  .pass:hover{
    text-decoration: underline;
  }
  input[type="submit"]
  {
    width: 100%;
    height: 50px;
    border:1px solid;
    background: #2691d9;
    border-radius: 25px;
    font-size: 18px;
    color:#e9f4fb;
    font-weight: 700;
    cursor: pointer;
    outline: none;
    margin-top:30px;
  }
  input[type="submit"]:hover{
    border-color: #2691d9;
    transition: .5s;
  }
  .signup_link {
    margin:30px 0;
    text-align:center;
    font-size:16px;
    color:#666666;
  }
  .signup_link a{
    color:#2691d9;
    text-decoration: none;
  }
  .signup_link a:hover{
    text-decoration: underline;
  }
}
.txt_field input:focus ~ label,
.txt_field input:valid ~ label
{
  top:-5px;
  color: #2691d9;
}

.txt_field input:focus ~ span::before,
.txt_field input:valid ~ span::before
{
  width:100%
}

.feedback_validation{
  color:red;
}
</style>