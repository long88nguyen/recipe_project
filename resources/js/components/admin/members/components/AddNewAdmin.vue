<template>
    <div class="form_create_admin">
        <form @submit.prevent="saveDataMember">
            <div class="form-group" >
                <label for="">Email</label>
                <input type="text" class="form-control" v-model="form_register.email">
            </div>
            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" class="form-control" v-model="form_register.password">
            </div>
            <div class="form-group">
                <label for="">Nhập lại mật khẩu</label>
                <input type="password" class="form-control" v-model="form_register.password_confirmation">
            </div>

            <input type="submit" class="btn btn-primary" value="Lưu thông tin">
        </form>
    </div>
</template>

<script>
export default {
   data(){
    return {
        form_register: {
        email: '',
        password:'',
        password_confirmation:'',
        is_admin:1,
      },
    }
   },
    methods:{
        async saveDataMember(){
            await this.$store.dispatch('auth/register',this.form_register).then(() => {
            this.$toast.success('Đăng ký tài khoản thành công!')
            this.$emit("ok")
            this.form_register.email = '',
            this.form_register.password = '',
            this.form_register.password_confirmation = ''
      }).catch(() =>{
        this.$toast.error('Đăng ký không thành công vui lòng kiểm tra lại!');
      })
        }
    }
}
</script>

<style>

</style>