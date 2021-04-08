<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-allergy</v-icon
          >&nbsp;สัมผัสผู้ติดเชื้อ
        </v-card-title>

        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">ข้อมูลทั่วไป</h3>
              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-autocomplete
                              v-model="idcard"
                              :items="cid"
                              label="เลข 13 หลัก"
                              :counter="13"
                              color="blue"
                              @change="cid_detail"
                            >
                            </v-autocomplete>
                          </v-col>

                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="mobile"
                              label="เบอร์โทร"
                              class="headline"
                              filled
                            ></v-text-field>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="work_position"
                              label="หน่วยที่ให้บริการ"
                              class="headline"
                              filled
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4">
                            <div class="body-1" v-if="showdetail">
                              <v-alert
                                color="#4a47a3"
                                dark
                                border="left"
                                prominent
                              >
                                ชื่อ-สกุล:&nbsp;{{ prename }}{{ name }}&nbsp;{{
                                  lastname
                                }}
                              </v-alert>
                            </div>
                          </v-col>
                          <v-col cols="12" md="4">
                            <div class="body-1" v-if="showdetail">
                              <v-alert
                                color="#4a47a3"
                                dark
                                border="left"
                                prominent
                              >
                                หน่วยงาน:&nbsp;{{ department }}
                              </v-alert>
                            </div>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">
                ประวัติเสี่ยง
              </h3>

              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row>
                          <v-col cols="12" md="4">
                            <v-select
                              :items="an"
                              label="สัมผัส AN"
                              filled
                            ></v-select>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-menu
                              v-model="fromDateMenu"
                              :close-on-content-click="false"
                              :nudge-right="40"
                              transition="scale-transition"
                              offset-y
                              max-width="290px"
                              min-width="290px"
                            >
                              <template v-slot:activator="{ on }">
                                <v-text-field
                                  label="วันที่สัมผัสผู้ติดเชื้อ"
                                  readonly
                                  :value="fromDateDisp"
                                  v-on="on"
                                ></v-text-field>
                              </template>
                              <v-date-picker
                                v-model="datecontact"
                                no-title
                                @input="fromDateMenu = false"
                                locale="th-TH"
                              ></v-date-picker>
                            </v-menu>
                          </v-col>
                          <v-col cols="12" md="4">
                            <v-text-field
                              v-model="timecontact"
                              type="number"
                              label="ระยะเวลาสัมผัส(นาที)"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            สัมผัสผู้ติดเชื้อ
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="contact"
                              label="ใช่"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="contact"
                              label="ไม่ใช่"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col cols="12" md="4" class="headline">
                            สัมผัสสารคัดหลั่งผู้ติดเชื้อ
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="contact"
                              label="ใช่"
                              value="yes"
                            ></v-checkbox>
                          </v-col>
                          <v-col cols="12" md="4" class="headline">
                            <v-checkbox
                              v-model="contact"
                              label="ไม่ใช่"
                              value="no"
                            ></v-checkbox>
                          </v-col>
                        </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
          </v-card>
        </v-flex>
        <v-flex xs12 md12>
          <v-card class="mx-auto">
            <v-alert border="top" colored-border color="#a7c5eb" elevation="2">
              <h3 class="texthead font-weight-bold teal--text">
                อาการและอาการแสดง
              </h3>
              <v-card class="mx-auto" outlined>
                <v-list-item three-line>
                  <v-list-item-content>
                    <v-form v-model="valid">
                      <v-container>
                        <v-row> </v-row>
                      </v-container>
                    </v-form>
                  </v-list-item-content>
                </v-list-item>
              </v-card>
            </v-alert>
          </v-card>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'
export default {
  components: {},
  data: () => ({
    idcard: '',
    idcardall: '',
    cid: '',
    contact_detail: '',
    work_position: '',
    department: '',
    prename: '',
    name: '',
    lastname: '',
    mobile: '',
    ancovid: [],
    an: '',
    contact: 'no',
    datecontact: '',
    timecontact: '',
    fromDateMenu: false,
    showdetail: false,
  }),
  mounted() {
    this.fetch_covid()
    this.fetch_idcard()
  },
  methods: {
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid.php`)
        .then((response) => {
          this.ancovid = response.data
          this.an = this.ancovid.map((item) => item.an)
        })
    },
    async fetch_idcard() {
      await axios
        .get(`${this.$axios.defaults.baseURL}cid.php`)
        .then((response) => {
          this.idcardall = response.data
          this.cid = this.idcardall.map((item) => item.cid)
        })
    },
    async cid_detail() {
      await axios
        .post(`${this.$axios.defaults.baseURL}cid_detail.php`, {
          idcard: this.idcard,
        })
        .then((response) => {
          this.contact_detail = response.data
          this.work_position = this.contact_detail.map(
            (item) => item.work_position
          )
          this.prename = this.contact_detail[0].prename
          this.name = this.contact_detail[0].name
          this.lastname = this.contact_detail[0].lastname
          this.department = this.contact_detail[0].in_department
          this.showdetail = true
        })
    },
  },
  computed: {
    fromDateDisp() {
      return this.datecontact
      // format/do something with date
    },
  },
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
.v-input {
  font-size: 1.2em;
  font-weight: 100;
}
</style>
