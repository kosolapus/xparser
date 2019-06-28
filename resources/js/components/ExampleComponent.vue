<template>
  <section>
    <div class="container ">
      <div class="row">
        <div class="col-12">
          <form class="mx-auto" style="max-width:500px" method="GET" action="/book24" enctype="multipart/form-data">
            <div class="form-group">
              <label for="link">Список ISBN</label>
              <textarea v-model="isbnlist" class="form-control isbn" name="isbn" aria-describedby="isbn" placeholder="Список ISBN, каждый новый - в новой строке" value=""></textarea>
            </div>
            <button type="submit" @click="gotoparse" class="btn btn-primary" >
              Получить анализ цен
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="container py-5">
      <div class="row">
        <div class="col-12" >
          <table class="table table-bordered">
            <tr>
              <td>Название книги</td>
              <td>ISBN</td>
              <td>Myshop</td>
              <td>Labirint</td>
              <td>Book24</td>
              <td>Просвещение</td>
              <td>Абрис</td>
              <td>Озон</td>
              <td>Читай-город</td>
            </tr>
            <tr v-for="item in items">
              <td>{{ item.title ||"" }}</td>
              <td>{{ item.isbn ||"" }}</td>
              <td>{{ item.pricelist["my-shop"]||""  }}</td>
              <td>{{ item.pricelist.labirint||""  }}</td>
              <td>{{ item.pricelist.book24||""  }}</td>
              <td>{{ item.pricelist.prosvet||""  }}</td>
              <td>{{ item.pricelist.tdabris||""  }}</td>
              <td>{{ item.pricelist.ozon||""  }}</td>
              <td>{{ item.pricelist["chitai-gorod"]||""  }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
    export default {
        data(){
          return {
            items:{},
            isbnlist:" 978-5-04-100301-2 "
          }
        },
        computed:{
          listByBreaks() {
            return this.isbnlist.split("\n");
          },
        },
        mounted() {
          var items = this.items;
          window.Echo.channel('andrey.1')
          .listen('.parser.book.accepted', function(e){
            if(!e.isbn || !e.price){
              return
            }
            var isbn = e.isbn[0].replace(/[^0-9]/g, '');

            if(!items[isbn]){
              Vue.set(items, isbn, e);
            }
            if(!items[isbn].pricelist){
              Vue.set(items[isbn],"pricelist", {});
            }
            Vue.set(items[isbn],"isbn", isbn);
            if(e.title && e.title.length>0){
              Vue.set(items[isbn],"title", e.title[0]);
            }
            Vue.set(items[isbn].pricelist,e.link,e.price[0].replace(/[^0-9]/g, ''));
            console.log(items);
          }).bind(items);
        },
        methods:{
          gotoparse:function(e){
            e.preventDefault();
            axios.post('/api/book24', {"isbn":this.isbnlist});
          return false;
        }
        }
    }

</script>
