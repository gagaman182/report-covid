<template>
  <v-app dark>
    <v-app-bar
      :clipped-left="clipped"
      color="#709fb0"
      fixed
      app
      justify="center"
    >
      <!-- <v-app-bar-nav-icon @click.stop="drawer = !drawer" /> -->
      <!-- ปุ่มลูกศร -->
      <!-- <v-btn icon @click.stop="miniVariant = !miniVariant">
        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>
      </v-btn> -->
      <!-- <v-btn icon @click.stop="clipped = !clipped">
        <v-icon>mdi-application</v-icon>
      </v-btn> -->
      <!-- <v-btn icon @click.stop="fixed = !fixed">
        <v-icon>mdi-minus</v-icon>
      </v-btn> -->
      <v-toolbar-title
        v-text="title"
        class="yellow--text headline font-weight-bold"
      />

      <!-- <h2 class="texthead">
        ระบบบันทึกข้อมูลผู้สัมผัสเสี่ยงในสถานพยาบาล :
        กรณีพบผู้ติดเชื้อในสถานพยาบาล
      </h2> -->
      <v-spacer />
      <!-- <v-btn icon @click.stop="rightDrawer = !rightDrawer">
        <v-icon>mdi-menu</v-icon>
      </v-btn> -->
    </v-app-bar>

    <v-main>
      <v-system-bar dark color="primary">
        <v-spacer></v-spacer>

        <v-icon>mdi-calendar-range </v-icon>{{ datenow }}
        <v-icon>mdi-clock-time-five-outline </v-icon> {{ timenow }}
      </v-system-bar>

      <v-container>
        <nuxt />
      </v-container>
    </v-main>

    <v-footer :absolute="!fixed" app>
      <span>&copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      datenow: new Date().toISOString().substr(0, 10),
      timenow: new Date().toString().substr(16, 5),
      clipped: true,
      drawer: true,
      fixed: true,
      items: [
        {
          icon: 'mdi-account-alert-outline ',
          title: 'รายงานพบผู้ติดเชื้อ',
          to: '/',
        },
        {
          icon: 'mdi-allergy ',
          title: 'สัมผัสผู้ติดเชื้อ',
          to: '/general',
        },
        {
          icon: 'mdi-monitor-dashboard ',
          title: 'เฝ้าระวัง 14 วัน',
          to: '/monitor',
        },
      ],
      admins: [
        {
          icon: 'mdi-account-check  ',
          title: 'เพิ่มผู้ติดเชื้อ',
          to: '/add-an',
        },
        // {
        //   icon: 'mdi-account   ',
        //   title: 'รายชื่อผู้สัมผัส',
        //   to: '/add-an',
        // },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: true,
      title:
        'ระบบบันทึกข้อมูลผู้สัมผัสเสี่ยงในสถานพยาบาล : กรณีพบผู้ติดเชื้อในสถานพยาบาล',
      collapseOnScroll: true,
    }
  },
}
</script>
<style>
body {
  font-family: 'Kanit', sans-serif;
  font-family: 'Prompt', sans-serif;
}
.texthead {
  color: #2d6187;
}
</style>
