<template>
  <v-layout row align-center>
    <v-flex xs12 md12>
      <v-card class="mx-auto">
        <v-card-title class="subheadline texthead font-weight-bold">
          <v-icon class="subheadline texthead font-weight-bold"
            >mdi-account-alert-outline </v-icon
          >&nbsp; รายงานพบผู้ติดเชื้อ
        </v-card-title>

        <v-alert
          v-for="item in ancovid"
          :key="item.num"
          text
          dense
          color="#ff005c"
          icon="mdi-clock-fast"
          border="left"
          >รายการที่ : {{ item.num }}
          <v-row>
            <v-col cols="12" class="text-center"> </v-col>
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                วันที่ : {{ item.date }}
              </v-card-text>
            </v-col>
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                AN : {{ item.an }}
              </v-card-text></v-col
            >
            <v-col cols="4" class="text-center">
              <v-card-text class="headline font-weight-bold">
                หอผู้ป่วย : {{ item.ward }}
              </v-card-text>
            </v-col>
          </v-row>
        </v-alert>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios'
export default {
  components: {},
  data: () => ({
    ancovid: [],
  }),
  mounted() {
    this.fetch_covid()
  },
  methods: {
    //แสดงข้อมูลร้านค้า
    async fetch_covid() {
      await axios
        .get(`${this.$axios.defaults.baseURL}covid_show.php`)
        .then((response) => {
          this.ancovid = response.data
        })
    },
  },
}
</script>
<style scoped>
.texthead {
  color: #2d6187;
}
</style>
