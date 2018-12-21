
<div id="secondary" class="four columns end">
<aside id="sidebar">

   <div class="widget widget_search">
      <h5>Search</h5>
      <form action="#">

         <input class="text-search" type="text" onfocus="if (this.value == 'Search here...') { this.value = ''; }" onblur="if(this.value == '') { this.value = 'Search here...'; }" value="Search here...">
         <input type="submit" class="submit-search" value="">

      </form>
   </div>
   <div class="widget link-list ">
      <h5 class="widget-title">Articles</h5>
      <ul class="link-list cf">
         @foreach($articles as $article)
         <li><i class="fa fa-stop"></i> <a href="/article/{{$article->slug}}">{{$article->title}}</a></li> 
         @endforeach
      </ul>
   </div>

   <div class="widget widget_categories">
      <h5 class="widget-title">Categories</h5>
      <ul class="link-list cf">
         @foreach($categories as $cat)
         <li><a href="/cat/{{str_slug($cat->name)}}">{{$cat->name}}</a></li> 
         @endforeach
      </ul>
   </div>

   <div class="widget widget_tag_cloud">
      <h5 class="widget-title">Tags</h5>
      <div class="tagcloud cf">
      @foreach($tags as $tag)
         <a href="#">{{$tag->name}}</a>
      @endforeach   
      </div>
   </div>

   <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   <script>
   (adsbygoogle = window.adsbygoogle || []).push({
      google_ad_client: "ca-pub-2501053704830755",
      enable_page_level_ads: true
   });
   </script>

</aside>

</div> <!-- Secondary End-->
