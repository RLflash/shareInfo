<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
*{margin:0;padding:0}
#app{
	min-width: 100vw;
	min-height: 100vh;
	background: #eee;
}
i{font-style:normal}
a:link{
text-decoration:none;
}
a:visited{
text-decoration:none;
}
a:hover{
text-decoration:none;
}
a:active{
text-decoration:none;
}
a{
	color:#000;
}
li{list-style: none;}
</style>
