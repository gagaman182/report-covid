<template>
  <v-row>
    <v-col cols="12" md="12">
      <v-row>
        <v-col col="12" md="6">
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
      <v-row
        ><v-col cols="12" md="12">
          <v-card-title class="subheadline texthead font-weight-bold">
            <v-icon class="subheadline texthead font-weight-bold"
              >mdi-form-textbox </v-icon
            >&nbsp;รายชื่อผู้สัมผัส
          </v-card-title></v-col
        >
        <v-row>
          <v-col cols="12" md="12">
            <v-toolbar card>
              <v-text-field
                v-model="search"
                flat
                solo
                prepend-icon="mdi-home-search-outline "
                placeholder="ค้นหา"
                hide-details
                class="elevation-1"
              ></v-text-field>
            </v-toolbar>
          </v-col>
        </v-row>

        <v-col cols="12">
          <v-data-table
            height="55vh"
            v-model="complex.selected"
            :headers="complex.headers"
            :search="search"
            :items="complex.items"
            class="elevation-1"
          >
            <template v-slot:body="{ items }">
              <tbody>
                <tr v-for="row in items">
                  <td>
                    {{ row.id }}
                  </td>
                  <td>
                    {{ row.cid }}
                  </td>
                  <td>
                    {{ row.fullname }}
                  </td>
                  <td>
                    {{ row.mobile }}
                  </td>
                  <td>
                    {{ row.department }}
                  </td>

                  <td>
                    <v-chip color="primary" dark>
                      {{ row.an }}
                    </v-chip>
                  </td>
                  <td>
                    {{ row.datecontact }}
                  </td>
                  <td>
                    {{ row.timecontact }}
                  </td>
                  <td>
                    <v-chip :color="getyes(row.concat_person)" dark>
                      {{ row.concat_person }}
                    </v-chip>
                  </td>
                  <td>
                    <v-chip :color="getyes(row.concat_secretion)" dark>
                      {{ row.concat_secretion }}
                    </v-chip>
                  </td>
                  <td>
                    <v-chip :color="getyes(row.concat_aerosol)" dark>
                      {{ row.concat_aerosol }}
                    </v-chip>
                  </td>
                  <td>
                    {{ row.clothing }}
                  </td>
                  <td>
                    <v-chip :color="getColor(row.temp)" dark>
                      {{ row.temp }}
                    </v-chip>
                  </td>

                  <td>
                    <v-chip :color="gettemp(row.temp_other)" dark>
                      {{ row.temp_other }}
                    </v-chip>
                  </td>
                  <td>
                    {{ row.symptom }}
                  </td>
                </tr>
              </tbody>
            </template>
          </v-data-table></v-col
        >
      </v-row>
    </v-col></v-row
  >
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
          value: 'id',
          width: '100px',
        },
        {
          text: 'หมายเลขบัตรประจำตัว',
          value: 'cid',
          width: '150px',
        },
        {
          text: 'ชื่อ-นามสกุล',
          value: 'fullname',
          width: '300px',
        },
        {
          text: 'เบอร์โทร',
          value: 'mobile',
          width: '100px',
        },

        {
          text: 'กลุ่มงาน',
          value: 'department',
          width: '300px',
        },
        {
          text: 'AN ผู้ป่วย',
          value: 'an',
          width: '150px',
        },
        {
          text: 'วันที่สัมผัสผู้ติดเชื้อ',
          value: 'datecontact',
          width: '200px',
        },
        {
          text: 'ระยะเวลาที่สัมผัส(นาที)',
          value: 'timecontact',
          width: '200px',
        },
        {
          text: 'สัมผัสผู้ติดเชื้อ',
          value: 'concat_person',
          width: '200px',
        },
        {
          text: 'สัมผัสสารคัดหลั่งผู้ติดเชื้อ',
          value: 'concat_secretion',
          width: '200px',
        },
        {
          text: 'สัมผัสละอองฝอยจากผู้ป่วย',
          value: 'concat_aerosol',
          width: '200px',
        },
        {
          text: 'ใส่ชุดป้องกันตามมาตรฐาน',
          value: 'clothing',
          width: '550px',
        },
        {
          text: 'มีอาการไข้',
          value: 'temp',
          width: '150px',
        },
        {
          text: 'อุณหภูม(°C)',
          value: 'temp_other',
          width: '150px',
        },
        {
          text: 'อาการแสดง',
          value: 'symptom',
          width: '550px',
        },
      ],
      items: [],
    },

    token: '1',
    session: '1',
    user: '1',
    hours: '',
    saved: '',
  }),
  mounted() {
    this.login()
    this.fetch_covid()
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
        .get(`${this.$axios.defaults.baseURL}contact_detail.php`)
        .then((response) => {
          this.complex.items = response.data
        })
    },

    getColor(temp) {
      if (temp == 'มีไข้') return 'red'
      else return 'green'
    },
    gettemp(temp_other) {
      if (temp_other >= 37.5) return 'red'
      else return 'green'
    },
    getyes(yes) {
      if (yes == 'ใช่') return 'red'
      else return 'green'
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
