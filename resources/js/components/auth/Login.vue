
<template>
    <div>
    <b-container>
        <b-form @submit.prevent="login">

            <b-form-group
            id="input-group-1"
            label="Email"
            >
            <b-form-input
                id="input-1"
                v-model="form.email"
                type="email"
                placeholder="Enter email"
            ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Password:" label-for="input-2">
            <b-form-input
                type="password"
                id="input-2"
                v-model="form.password"
                placeholder="Password"
            ></b-form-input>
            </b-form-group>


            <b-button type="submit" class="ml-2" variant="primary">Submit</b-button>
            <b-button type="reset" variant="danger">Reset</b-button>
      </b-form>
    </b-container>

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
