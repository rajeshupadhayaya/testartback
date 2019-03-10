@extends('layouts.app')

@section('content')
<div class="home">

  <section id="info" class="info">
    <h1 class="title">We are an Science Excel publisher that puts our authors' interests at the heart of everything.</h1>
  </section> 

  <section class="info-container info" >
    <div class="detail-info">
      <div class="text-center">
        <h4 >Thinking of publishing with us?</h4>
      </div>
      <div class="row">
        <div class="col-sm-6">
            <div class="info-inner">
              <h5 >Constructive feedback</h5>
              <p >Rigorous and helpful peer review guides you to improve your manuscript.</p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="info-inner">
              <h5>100% Open Access</h5>
              <p >Immediate free access makes articles easy to find and cite. Indexing in key databases assures quality and integrity.</p>
            </div>
        </div>
      </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="info-inner">
              <h5>"Pay what you can"</h5>
              <p >Our 'Freedom Article Publishing Charges' allow you to select the article publishing charge contribution you can afford.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="info-inner">
              <h5>Authors love us</h5>
              <p >Survey results show that our authors rate us 9/10 for their overall satisfaction with the publishing experience.</p>
            </div>
          </div>
      </div>
    </div>
  </section>

  <section id="menu-block">

    <div class="menu-cards">
      <div class="flex-item">
        <a href="{{ route('journal') }}">
          <div class="menu-container blue-grad">
            <i class="fas fa-book-open"></i>
            <h5>Journals</h5>
          </div>
        </a>
      </div>
      <div class="flex-item">
        <a href="{{ route('guidelines') }}">
          <div class="menu-container green-grad">
            <i class="fas fa-book-open"></i>
            <h5>Guidelines</h5>
          </div>
        </a>
      </div>
      <div class="flex-item">
        <a href="{{ route('menuscript') }}">
          <div class="menu-container orange-grad">
            <i class="far fa-newspaper"></i>
            <h5>Submit Menuscript</h5>
          </div>
        </a>
      </div>
      <div class="flex-item">
        <a href="{{ route('contactus') }}">
          <div class="menu-container purple-grad">
            <i class="fas fa-phone"></i>
            <h5>Contact Us</h5>
          </div>
        </a>
      </div>
    </div>
  </section>

  <section id="featureJournal">
    <div class="container">
      <div class="text-center"><h4>Feature Journals</h4></div>
      <!-- <hr> -->
      <div class="row"> 
          @foreach ($journals as $journal)
          <div class="col">
              <div class="card bg-light journal-cards" style="width: 18rem;">
                <a href="{{ str_replace(' ','-', $journal->sub_category_name) }}">

                  @if($journal->category_image === '')
                    <img class="card-img-top" src="{{ asset('images/placeholder.png') }}" alt="Image can not load">
                  @else
                    <img class="card-img-top" src="{{ $journal->category_image }}" alt="Image can not load">
                  @endif
                  <div class="card-body">
                    <h5 class="card-title">{{ $journal->sub_category_name }}</h5>
                    <p class="card-text">{{ $journal->description }}</p>
                    
                  </div>
                </a>
                
              </div>
          </div>
          
          @endforeach
      </div>
    </div>
  </section>
  <?php
  $numOfCols = 4;
  $rowCount = 0;
  $bootstrapColWidth = 12 / $numOfCols;
  ?>
  <section id="recentArticle">
    <div class="container">
      <div class="text-center"><h4 class="section-header">Recent Articles</h4></div>
      <div class="row"> 
          @foreach ($articles as $article)
              <div class="col">

                <div class="card bg-light journal-cards" style="width: 18rem;">
                  <a href="{{ route('article') }}/{{ str_replace(' ','-', $article->title) }}">
                  @if($article->article_image == '')
                  <img class="card-img-top" src="{{ asset('images/placeholder.png') }}" alt="Image can not load">
                  @else
                  <img class="card-img-top" src="{{ $article->article_image }}" alt="Image can not load">
                  @endif
                    <div class="card-body">
                      <h5 class="card-title">{{ $article->title }}</h5>
                      <p class="card-text">written by {{ $article->authors}}</p>
                      <p><i class='fas fa-calendar-alt'></i> &nbsp; {{ $article->published_date }}</p>
                      
                    </div>
                  </a>
                </div>
               
          </div>
          @endforeach
      </div>
      </div>
  </section>
</div>

    
</div>
@endsection
