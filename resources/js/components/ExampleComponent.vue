<template>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6"><h4>Выбери нужные магазины</h4></div>
        <div class="col-12 col-md-6"><h4>Вставь список ISBN</h4></div>
        <div class="col-12 col-md-6">

          <ul class="list-group">
            <label for="amital">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'amital' ) != -1 ) }">
                Amital
                <input class="d-none" type="checkbox" id="amital" name="amital" value="amital" v-model="shops">
              </li>
            </label>
            <label for="chitayGorod">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'chitayGorod' ) != -1 ) }">
                Читай-город
                <input class="d-none" type="checkbox" id="chitayGorod" name="chitayGorod" value="chitayGorod" v-model="shops">
              </li>
            </label>
            <label for="abris">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'abris' ) != -1 ) }">
                Абрис
                <input class="d-none" type="checkbox" id="abris" name="abris" value="abris" v-model="shops">
              </li>
            </label>
            <label for="ozon">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'ozon' ) != -1 ) }">
                Озон
                <input class="d-none" type="checkbox" id="ozon" name="ozon" value="ozon" v-model="shops">
              </li>
            </label>
            <label for="labirint">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'labirint' ) != -1 ) }">
                Лабиринт
                <input class="d-none" type="checkbox" id="labirint" name="labirint" value="labirint" v-model="shops">
              </li>
            </label>
            <label  for="myShop">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'myShop' ) != -1 ) }">
                My-Shop
                <input class="d-none" type="checkbox" id="myShop" name="myShop" value="myShop" v-model="shops">
              </li>
            </label>
            <label for="book24">
              <li class="list-group-item" :class=" { 'active': ( shops.indexOf( 'book24' ) != -1 ) }">
                Book24
                <input class="d-none" type="checkbox" id="book24" name="book24" value="book24" v-model="shops">
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
        </div>
        <div class="col-12 text-center">
          <table class="table table-bordered">
            <tr>
              <td>ISBN</td>
              <td v-for="shop in shops">{{shop}}</td>
            </tr>
            <tr v-for="item in isbnlist">
              <td>{{item}}</td>
              <td v-for="shop in shops" :data-item="item" :data-shop="shop"></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
    export default {
      data:function(){
        return {
          info:null,
          isbn:`9780552159845
          9788528622003
          9781481525503
          9783453126770
          9780739474143
          9789985620298
          9784041083840
          9780061121302
          9780575048003
          9785040397181
          9789639868939
          9780753125809
          9787536465251
          9788952795649
          9789616767804
          9781440758270
          9788448040253
          9780517126646
          9780552167406
          9788528624168
          9780062697257
          9780894808531
          9783492285056
          9789722332804
          9780606311779
          9781486274390
          9781440758263
          9788804579915
          9781448110230
          9781486274413
          9781481525497
          9782290088401
          9788479048778
          9789616767866
          9788528606621
          9781594970986
          9780061967078
          9780062896957
          9781473214712
          9788376481142
          9783492281669
          9780062836977
          9780616442609
          9781440758256
          9780060853969
          9783492960014
          9780062934918
          9788376488592
          9780061735813
          9788804544623
          9784041083833`,
          shops:[]
        }
      },
      computed:{
        isbnlist:function(){
          return this.isbn.split("\n");
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
          var data = {
            isbn:this.isbnlist,
            shops:this.shops
          }
          axios
            .post(url, data)
            .then(response => (this.info = response));
        }
      }
    }
</script>

<style media="screen">
  label{
    margin:0px!important;
  }
</style>
