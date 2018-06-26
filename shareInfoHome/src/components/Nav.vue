<template>
	<div class="nav">
		<div class="kindswrap">
			<div class="kinds">
				<router-link :to="{path:'/'}"><li>首页</li></router-link>
				<router-link v-for="navli in navlis" :key="navli.index" :to="{path:'/list',query:{kinds:navli}}"><li :class="{lactive:onelea==navli}">{{navli}}</li></router-link>
			</div>
		</div>
		<div class="name" v-show="kindsname!=undefined">
			<router-link :to="{path:'/list',query:{kinds:kindsname}}"><li :class="{active:all=='all'}">全部</li></router-link>
			<router-link v-for="nav in navs" :key="nav.index" :to="{path:'/list',query:{kinds:kindsname,name:nav.twograde}}" ><li :class="{active:all==nav.twograde}">{{nav.twograde}}</li></router-link>
		</div>
	</div>
</template>

<script>
	export default{
		name:'Nav',
		data(){
			return{
				navlis:[],
				navs:[],
				kindsname:undefined,
				onelea:"",
				all:'all'
			}
		},	
		methods:{
			getnav:function(name){
				var self=this
				return Promise.all([
					this.axios.post('http://127.0.0.1/shareInfo/index.php/Home/Index/index'),
					this.axios.get('http://127.0.0.1/shareInfo/index.php/Home/Index/getsecondnav?onenav='+name)
				]).then(function ([navlis,navs]){
	        	  	 self.navlis=navlis.data
	        	  	 self.navs=navs.data
	        	})
			}
		},
		created:function(){
			var self=this;
			console.log(this.$route.query)
			this.kindsname=this.$route.query.kinds;
			self.getnav(this.$route.query.kinds)
			if(this.$route.query.kinds==undefined){
		        this.onelea='';
		    }else{
		        this.onelea=this.$route.query.kinds;
		    }
			if(this.$route.query.name==undefined){
		        this.all='all';
		    }else{
		        this.all=this.$route.query.name;
		    }
		},
		watch:{  
			$route(to,from){   
				var self=this
		        this.kindsname=this.$route.query.kinds;

		       	self.getnav(to.query.kinds)
		        if(to.query.kinds==undefined){
		        	this.onelea='';
			    }else{
			        this.onelea=this.$route.query.kinds;
			    }
		        if(to.query.name==undefined){
		        	this.all='all';
		        }else{
		        	this.all=to.query.name;
		        }
		    }
		}
	}
</script>
<style lang="scss" scoped>

		.kindswrap{
			width:100%;
			background:#07111b;
			.kinds{
				width:1200px;
				margin:auto;
				height:70px;
				clear:both;
				.lactive{
					background: #1f4367;
    color: #fff;
				}
				a{
					display: inline-block;
					color: rgba(255,255,255,.6);
					li{
						min-width: 139px;
						height:70px;
						text-align: center;
						line-height: 70px;
						font-size:20px;
						font-weight: 600;
					}
				}		
				.router-link-exact-active{
					color:#fff;
				}
			}
		}
		.name{
			width:1200px;
			height:70px;
			margin:auto;
			clear:both;	
			/*border-bottom: 1px solid #e2cece;*/
			margin-bottom: 20px;		
			li{
				float: left;
			    min-width: 50px;
			    height: 50px;
			    line-height: 50px;
			    text-align: center;
			    margin: 10px;
			    cursor: pointer;
			    padding:0 10px;
			}
			.active{
				background:#2b333b;
				color:#fff;
			}
		}
	
</style>




	
