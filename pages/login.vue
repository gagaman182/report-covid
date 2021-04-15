<template>
  <v-app id="inspire">
    <v-content>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md4>
            <v-card class="elevation-12">
              <v-toolbar dark color="#709fb0 " class="yellow--text">
                <v-toolbar-title>เข้าสู่ระบบ </v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form>
                  <p class="body-1 font-weight-bold">Username</p>
                  <v-text-field
                    append-icon=" mdi-file-account "
                    name="login"
                    type="text"
                    v-model="username"
                    solo
                  ></v-text-field>
                  <p class="body-1 font-weight-bold">Password</p>
                  <v-text-field
                    append-icon=" mdi-eye"
                    name="password"
                    type="password"
                    v-model="password"
                    solo
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn
                  color="#709fb0 "
                  block
                  class="yellow--text font-weight-bold"
                  @click="login()"
                  >ตกลง</v-btn
                >
              </v-card-actions>
            </v-card>
            <v-flex xs12>
              <v-layout column align-center>
                <v-btn
                  :loading="loading"
                  class="ma-1"
                  color="error"
                  plain
                  @click="remove"
                  x-large
                >
                  <NuxtLink to="/">กลับหน้าหลัก</NuxtLink>
                </v-btn>
              </v-layout>
            </v-flex>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import axios from 'axios'
export default {
  layout: 'login',

  data() {
    return {
      username: '',
      password: '',
      token: '',

      loginok: '',
      tokens: '',
      erroralert: '',
    }
  },
  methods: {
    login() {
      axios
        .post(`${this.$axios.defaults.baseURL}login_check.php`, {
          user: this.username,
          pass: this.password,
        })

        .then((response) => {
          this.tokens = response.data
          localStorage.setItem('token', JSON.stringify(this.tokens))
          localStorage.setItem('saved', new Date().getTime())
          this.token = JSON.parse(localStorage.getItem('token'))
          if (this.token[0].state == 'no') {
            this.popuplogin()
            this.clear()

            this.$router.push('/login')
          } else {
            this.$router.push('/add-an')
          }
        })
    },
    popuplogin() {
      this.$swal({
        title: 'แจ้งเตือน',
        text: 'ท่านไม่ได้รับอณุญาติให้เข้าสู่ระบบ',
        icon: 'error',
        confirmButtonText: 'ตกลง',
      })
    },
    clear() {
      this.username = ''
      this.password = ''
    },
  },
}
</script>

<style></style>
