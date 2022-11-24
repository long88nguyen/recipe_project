
<template>
    <div>
      <div class="container">
        <h1>Login</h1>
        <form action="" @submit.prevent="login">
        <div class="form-group">
            <label for="">email</label>
            <input type="text" class="form-control" v-model = "form.email">
        </div>
        <div class="form-group">
            <label for="">password</label>
            <input type="password" class="form-control" v-model = "form.password">
        </div>
        <button class="btn btn-outline-primary mt-2">
          Login
        </button>
      </form>
      </div>
    
    </div>
  </template>

  <script>
    export default {
      data() {
        return {
          form: {
            email: 'admin@gmail.com',
            password:'123456'
          },
        }
      },
      methods: {
        async login() {
            console.log("login ssssssss",this.form)
      await this.$store.dispatch('auth/login', this.form)
        .then(() => {
          this.$router.push({path: "/categories"});
        })
        .catch(() => {
        //   this.$root.$loading.finish();
        //   this.$toast(
        //     this.$t("popup.label_login_fail"),
        //     this.$t("login.label_button_login"),
        //     2000,
        //     "b-toaster-top-center",
        //     "danger"
        //   );
        console.log("errrrrrrrrrrrrrrr")
        });
    },
      }
    }
  </script>
