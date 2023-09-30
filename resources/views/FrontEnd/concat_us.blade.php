@include('FrontEnd.header')
@foreach($concat_us as $a)

<main>
    <section class="abour=t_us">
        <div id="main_staticpage" >
            <div class="titleWrapper" id="div_main_static">
              <div class="title" id="title_static">تواصل معنا</div>
              <div class="updateDate" id="div_staticupdate">
                <span>التحديث الاخير</span><span></span> - <span>{{$a->update_date}}</span>
              </div>
    </section>

    <section class="section-10" id="section_staticpage">
    <div class="container" id="divsection_staticpage">
    <h1 class="my-3" id="h1_staticpage">{{$a->title}}</h1>         
    <pre id="pre_staticpage">{{$a->content}}</pre>            @endforeach
        </div>
    </section>
</main>
@include('FrontEnd.footer')