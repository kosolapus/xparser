<template>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6"><h4>Выбери нужные магазины</h4></div>
        <div class="col-12 col-md-6"><h4>Вставь список ISBN</h4></div>
        <div class="col-12 col-md-6">

          <ul class="list-group">
            <label v-for="shop in shopsList" :for="shop.value">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( shop.value ) != -1 ) }">
                {{shop.name}}
                <input class="d-none" type="checkbox" :id="shop.value" :name="shop.value" :value="shop.value" v-model="shops">
              </li>
            </label>
          </ul>
        </div>
        <div class="col-12 col-md-6">
          <div class="form-group h-100">
            <textarea class="form-control h-100" v-model="isbn"></textarea>
          </div>
        </div>
        <div class="col-12 text-center">
          <button class="my-4 btn btn-success btn-xl" v-on:click.prevent="startParse()" >Парсь меня полностью!</button>
          <p>Задачи парсинга: {{this.counter}}</p>
        </div>
        <div class="col-12 text-center">
          <table class="table table-bordered">
            <tr>
              <td>ISBN</td>
              <td v-for="shop in shops">{{shop}}</td>
            </tr>
            <tr v-for="isbn in isbnlist">
              <td>{{isbn}}</td>
              <td v-for="shop in shops" :data-shop="shop" :data-isbn="isbn"></td>
            </tr>
          </table>
        </div>

      </div>
    </div>
  </section>
</template>

<script>
    require('../api');
    export default {
      data:function(){
        return {
          counter:0,
          isbn:`978-5-8112-6473-5`,
          shops:[],
          shopsList:[
            {name:"Amital",value:"amital"},
            {name:"Читай-город",value:"chitaiGorod"},
            {name:"Абрис",value:"abris"},
            {name:"Озон",value:"ozon"},
            {name:"Лабиринт",value:"labirint"},
            {name:"My-Shop",value:"myShop"},
            {name:"Book24",value:"book24"},
            {name:"Просвещение",value:"prosveshenie"},
          ]
        }
      },
      computed:{
        isbnlist:function(){
          return this.isbn.replace(/ /g,"").split("\n");
        }
      },
      provide:function(){
        return {
          shops:this.shops
        }
      },
      methods:{
        startParse:function(){

          var url = "/testnoty";
          this.counter = this.isbnlist.length*this.shops.length;
          for(var isbn_id in this.isbnlist){
            for(var shop_id in this.shops){
              var shop = this.shops[shop_id];
              var isbn = this.isbnlist[isbn_id];
              var self = this;

              document.querySelector('[data-shop="'+shop+'"][data-isbn="'+isbn+'"]').classList.add("bg-warning")
              axios
                .post(url, {shop:shop, isbn:isbn})
                .then(function(response){
                  console.log(response.data.json);
                  document.querySelector('[data-shop="'+response.data.shop+'"][data-isbn="'+response.data.isbn+'"]').classList.remove("bg-warning")

                  console.log(parseInt(response.data.json)>0);
                  if(parseInt(response.data.json)>0){
                    document.querySelector('[data-shop="'+response.data.shop+'"][data-isbn="'+response.data.isbn+'"]').classList.add("bg-success")
                    document.querySelector('[data-shop="'+response.data.shop+'"][data-isbn="'+response.data.isbn+'"]').innerText = response.data.json;
                  } else {
                    document.querySelector('[data-shop="'+response.data.shop+'"][data-isbn="'+response.data.isbn+'"]').classList.add("bg-danger")
                  }
                  self.counter--;

                }.bind(self))
                .catch(function(){});
            }
          }


        }
      }
    }
</script>

<style media="screen">
  label{
    margin:0px!important;
  }
</style>
