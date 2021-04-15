<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-row
        ><v-col col="12" md="6">
          <div>
            <v-card-title color="orange lighten-2">
              ผู้ใช้งานระบบ : {{ user }}
            </v-card-title>
          </div>
        </v-col>
        <v-col col="12" md="6">
          <div align="end">
            <v-btn class="ma-1" color="error" plain x-large @click="logout()">
              ออกจากระบบ
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <v-card class="mx-auto">
        <v-row>
          <v-col cols="12" md="6">
            <v-card-title class="subheadline texthead font-weight-bold">
              <v-icon class="subheadline texthead font-weight-bold"
                >mdi-account-check </v-icon
              >&nbsp;เพิ่มผู้ติดเชื้อ
            </v-card-title></v-col
          >
          <v-col cols="12" md="6">
            <div align="end">
              <v-btn
                x-large
                v-if="btnmain"
                class="red--text text--lighten-5 ma-1"
                color="#7579e7"
                @click="showadd()"
              >
                <v-icon medium>mdi-file-plus-outline </v-icon>เพิ่ม
              </v-btn>
            </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" align="end">
            <v-toolbar card>
              <v-text-field
                v-model="search"
                flat
                solo
                prepend-icon="mdi-home-search-outline "
                placeholder="ค้นหา"
                hide-details
                class="hidden-sm-and-down"
              ></v-text-field>
            </v-toolbar>
          </v-col>
        </v-row>
        <v-divider></v-divider>
        <v-card class="mx-auto" outlined>
          <v-list-item three-line>
            <v-list-item-content>
              <v-row justify="center">
                <v-col cols="12" sm="3" justify="center">
                  <!-- <v-text-field
              v-model="date"
              label="วันที่"
              outlined
              v-if="textboxshow"
            ></v-text-field> -->

                  <v-date-picker
                    v-model="date"
                    color="#7579e7"
                    locale="th-TH"
                    v-if="textboxshow"
                  ></v-date-picker>
                </v-col>

                <v-col cols="12" sm="4">
                  <v-text-field
                    v-model="an"
                    label="AN"
                    outlined
                    v-if="textboxshow"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="4">
                  <!-- <v-text-field
              v-model="ward"
              label="หอผู้ป่วย"
              outlined
              v-if="textboxshow"
            ></v-text-field> -->
                  <v-select
                    v-if="textboxshow"
                    :items="ward_list"
                    v-model="ward"
                    item-text="HALFPLACE"
                    item-value="HALFPLACE"
                    label="หอผู้ป่วย"
                    outlined
                  ></v-select>
                </v-col>

                <v-col cols="12" align="end">
                  <v-btn
                    large
                    v-if="btnadd"
                    class="red--text text--lighten-5"
                    color="teal lighten-1"
                    flat
                    @click="adddata()"
                  >
                    <v-icon medium>mdi-content-save </v-icon>บันทึก</v-btn
                  >
                  <v-btn
                    large
                    v-if="btneditandremove"
                    color="#0e49b5"
                    @click="updatedata()"
                    dark
                  >
                    <v-icon medium>mdi-content-save-edit </v-icon>
                    <h4>แก้ไข</h4></v-btn
                  >
                  <v-btn
                    large
                    v-if="btneditandremove"
                    color="#c56183"
                    @click="removedata()"
                    dark
                  >
                    <v-icon medium>mdi-delete-forever </v-icon>
                    <h4>ลบ</h4></v-btn
                  >
                  <v-btn
                    large
                    v-if="btncancel"
                    color="#b088f9"
                    class="red--text text--lighten-5"
                    flat
                    @click="cleartext"
                  >
                    <v-icon medium>mdi-autorenew </v-icon>ยกเลิก</v-btn
                  >
                </v-col>
                <v-col cols="12">
                  <v-data-table
                    height="40vh"
                    v-model="complex.selected"
                    :headers="complex.headers"
                    :search="search"
                    :items="complex.items"
                    class="elevation-1 display-2"
                  >
                    <template v-slot:body="{ items }">
                      <tbody>
                        <tr v-for="row in items" @click="selectItem(row)">
                          <!-- <td v-for="col in row">
                      {{ col }}
                    </td> -->
                          <td>
                            {{ row.num }}
                          </td>
                          <td>
                            {{ row.date }}
                          </td>
                          <td>
                            {{ row.an }}
                          </td>
                          <td>
                            {{ row.ward }}
                          </td>
                        </tr>
                      </tbody>
                    </template>
                    <!-- <template slot="items" slot-scope="props">
                <tr @click="showAlert(props.item)">
                  <td>{{ props.item.nums }}</td>
                  <td>{{ props.item.date }}</td>
                  <td>{{ props.item.an }}</td>
                  <td>{{ props.item.ward }}</td>
                </tr></template
              > -->
                  </v-data-table>
                </v-col>
              </v-row>
            </v-list-item-content>
          </v-list-item>
        </v-card>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    search: '',
    complex: {
      selected: [],
      headers: [
        {
          text: 'รายการที่',
          value: 'num',
        },
        {
          text: 'วันที่',
          value: 'date',
        },
        {
          text: 'AN',
          value: 'an',
        },
        {
          text: 'หอผู้ป่วย',
          value: 'ward',
        },
      ],
      items: [],
    },
    num: '',
    date: '',
    an: '',
    ward: '',
    ward_list: '',
    textboxshow: false,
    btneditandremove: false,
    btnmain: true,
    btnadd: false,
    btncancel: false,

    token: '1',
    session: '1',
    user: '1',
    hours: '',
    saved: '',
  }),
  mounted() {
    this.login()
    this.fetch_covid()
    this.fetch_ward()
  },
  methods: {
    // check login
    login() {
      //check login
      this.session = JSON.parse(localStorage.getItem('token'))
      //ถ้าไม่มี session จาก ฐานข้อมูลคือไม่ได้ login ให้กลับไปหน้า /login
      if (!this.session) {
        this.$router.push('/login')
      } else {
        this.user = this.session[0].fullname
        this.token = this.session[0].token

        if (this.token.length <= 0) {
          this.$router.push('/login')
        } else {
          // login 2 ชม ถ้าเกินให้ออก แล้ว clear localstorage
          this.hours = 2
          this.saved = localStorage.getItem('saved')
          if (
            this.saved &&
            new Date().getTime() - this.saved > this.hours * 60 * 60 * 1000
          ) {
            localStorage.clear()
            this.$router.push('/login')
          }
        }
      }
    },

    logout() {
      localStorage.removeItem('token')
      localStorage.clear()
      this.$router.push('/login')
    },
    //แสดงข้อมูลผู้ป่วย covid
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid.php`)
        .then((response) => {
          this.complex.items = response.data
        })
    },
    //แสดงข้อมูล ward
    async fetch_ward() {
      await axios
        .get(`${this.$axios.defaults.baseURL}ward_list.php`)
        .then((response) => {
          this.ward_list = response.data
        })
    },
    // click table
    selectItem(value) {
      this.num = value.num
      this.date = value.date
      this.an = value.an
      this.ward = value.ward
      this.btneditandremove = true
      this.textboxshow = true
      this.btncancel = true
      this.btnadd = false
    },

    //show textbox and btn
    showadd() {
      this.btnadd = true
      this.btncancel = true
      this.textboxshow = true
      this.btnmain = false
    },
    //เพิ่มข้อมูล
    adddata() {
      if (!this.date || !this.an || !this.ward) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ระบุข้อมูลไม่ครบ',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        axios
          .post(`${this.$axios.defaults.baseURL}add_an.php`, {
            date: this.date,
            an: this.an,
            ward: this.ward,
          })
          .then((response) => {
            this.message = response.data
            if (this.message[0].message === 'เพิ่มข้อมูลสำเร็จ') {
              this.$swal({
                title: 'สถานะการเพิ่ม',
                text: this.message[0].message,
                icon: 'success',
                confirmButtonText: 'ตกลง',
              })
              this.fetch_covid()
              this.cleartext()
            } else {
              this.$swal({
                title: 'สถานะการเพิ่ม',
                text: this.message[0].message,
                icon: 'error',
                confirmButtonText: 'ตกลง',
              })
            }
          })
      }
    },

    //ลบ ข่อมูล
    removedata() {
      if (!this.an) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ไม่พบข้อมูล',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        this.$swal({
          title: 'คุณแน่ใจว่าต้องการลบข้อมูลนี้?',
          text: 'รายการที่: ' + this.num,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#51adcf',
          cancelButtonColor: '#686d76',
          confirmButtonText: 'ลบ',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          if (result.isConfirmed) {
            axios
              .put(`${this.$axios.defaults.baseURL}delete_an.php`, {
                num: this.num,
              })
              .then((response) => {
                this.message = response.data

                if (this.message[0].message === 'ลบข้อมูลสำเร็จ') {
                  this.$swal({
                    title: 'สถานะการลบ',
                    text: this.message[0].message,
                    icon: 'success',
                    confirmButtonText: 'ตกลง',
                  })
                  this.fetch_covid()
                  this.cleartext()
                } else {
                  this.$swal({
                    title: 'สถานะการลบ',
                    text: this.message[0].message,
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                  })
                }
              })
          }
        })
      }
    },
    //แก้ไข ข้อมูล
    updatedata: function () {
      if (!this.an) {
        this.$swal({
          title: 'แจ้งเตือน',
          text: 'ไม่พบข้อมูล',
          icon: 'error',
          confirmButtonText: 'ตกลง',
        })
      } else {
        axios
          .put(`${this.$axios.defaults.baseURL}update_an.php`, {
            num: this.num,
            date: this.date,
            an: this.an,
            ward: this.ward,
          })
          .then((response) => {
            this.message = response.data
            if (this.message[0].message === 'แก้ไขข้อมูลสำเร็จ') {
              this.$swal({
                title: 'สถานะการแก้ไข',
                text: this.message[0].message,
                icon: 'success',
                confirmButtonText: 'ตกลง',
              })
              this.fetch_covid()
              this.cleartext()
            } else {
              this.$swal({
                title: 'สถานะการแก้ไข',
                text: this.message[0].message,
                icon: 'error',
                confirmButtonText: 'ตกลง',
              })
            }
          })
      }
    },
    cleartext() {
      this.btnadd = false
      this.btncancel = false
      this.textboxshow = false
      this.btnmain = true
      this.btneditandremove = false
      this.date = ''
      this.an = ''
      this.ward = ''
    },
  },
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
.v-data-table > .v-data-table__wrapper > table > tbody > tr > td {
  font-weight: bold;
  font-size: 20px;
}
</style>
