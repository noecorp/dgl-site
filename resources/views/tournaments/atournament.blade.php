<!--
 * Copyright 2018 DAGAMELEAGUE

 ____    ___  __
(  _ \  / __)(  )
 )(_) )( (_-. )(__  / _/ _ \ '_/ -_)_/ _/ _ \ '  \
(____/  \___/(____) \__\___/_| \___(_)__\___/_|_|_|

  @author XEQTIONR
  @template atournament
-->
@extends('layouts.main')

@section('body-section')

  <div class="row justify-content-center banner-background">
    <div class="col-12  px-0 mt-5">
      {{--Dynamic background URL--}}
      <style>
        {{--.jumbotron-atournament::after {--}}
          {{--background: url({{$tournament->banner}});--}}
        {{--}--}}
      </style>
      <div class="jumbotron-fluid jumbotron-atournament d-flex flex-column justify-content-center" style="background-image: url('{{$tournament->banner}}');
                                                                background-position: center; min-height: 450px !important;
        align-items: center;">

        @if($tournament->logo && $tournament->logo_visibility == 'visible')
          {{--<div id="tournamentLogoDiv" class="" style="min-height: 100px; max-height: 300px;">--}}
            <img id="tournamentLogo" src="{{$tournament->logo}}"}} style="width: auto; min-height: 100px; max-height: 200px;" alt="{{$tournament->name}} Logo">
          {{--</div>--}}
        {{--@else--}}
          {{--<div class="aspacer mt-5 row" style="min-height: 150px;">--}}
          {{--</div>--}}
        @endif
          <div class="row tournament-name-row mt-3 justify-content-center">
          <div class="col-12">
          @if(!($tournament->logo && $tournament->logo_visibility == 'visible'))
          <h1 class="display-5 text-center">{{$tournament->name}}</h1>
          @endif
          <h5 class="text-center">
            {{$tournament->local_start_string}}
            -
            {{$tournament->local_end_string}}
          </h5>
          </div>
          </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center sub-menu bg-gray5">
    <div class="col-12 nav-container" >
      <nav class="nav justify-content-center">
        <a class="nav-link active" id="navOverview" href="#overviewRow">Overview</a>
        <a class="nav-link" id="navInfo" href="#infoRow">Information</a>
        <a class="nav-link" id="navTeams" href="#teamsRow">Teams</a>
        <a class="nav-link" id="navRules" href="#rulesRow">Rules</a>
        <a class="nav-link" id="navRegistration" href="#registerRow">Registration</a>
      </nav>
    </div>
  </div>
  <div class="row justify-content-center bg-gray5">
    <div class="col-12  px-4 px-md-5 my-0" style="">
      <div class="row mt-4 mw">
        <div class="col-12 col-md-8 main-slot p-4">

          <script>
              $( document ).ready(function(){

                  $('.tournament-row').hide();
                  $('.tournament-row-overview').show();

                  $('#navOverview').click(function () {
                      $('.nav-link').removeClass('active');
                      $('#navOverview').addClass('active');
                      $('.tournament-row').hide();
                      $('.tournament-row-overview').show();
                  });

                  $('#navInfo').click(function () {
                      $('.nav-link').removeClass('active');
                      $('#navInfo').addClass('active');
                      $('.tournament-row').hide();
                      $('.info-row').show();

                  });
                  $('#navTeams').click(function () {
                      $('.nav-link').removeClass('active');
                      $('#navTeams').addClass('active');
                      $('.tournament-row').hide();
                      $('.tournament-row-teams').show();
                  });
                  $('#navRules').click(function () {
                      $('.nav-link').removeClass('active');
                      $('#navRules').addClass('active');
                      $('.tournament-row').hide();
                      $('.tournament-row-rules').show();
                  });
                  @if($tournament->logo && $tournament->logo_visibility == 'visible')
                  $('.jumbotron-atournament').hover(function(){
                     $('#tournamentLogo, .tournament-name-row').fadeTo("1","0");
                     //$('#tournamentLogo').css('opacity', '0');
                     //$('#tournamentLogo').css('display', 'block');
                     //$('.jumbotron-atournament::after').css('background-color', 'blue');
                  }
                  ,
                      function(){
                      $('#tournamentLogo, .tournament-name-row').fadeTo("1","1");
                  }
                  );

                  @endif
                  @if($tournament->registration_active)
                    $('#navRegistration').click(function () {
                        console.log('navreg');
                        $('.nav-link').removeClass('active');
                        $('#navRegistration').addClass('active');
                        $('.tournament-row').hide();
                        $('.register-row').show();
                    });
                  @else
                      $('#navRegistration').addClass("disabled");
                      $('#navRegistration').click(function () {

                          toastr.options = {
                              "closeButton": true,
                              "timeOut": "8000",
                              "preventDuplicates": true
                          }
                          toastr.error("Currently not accepting registrations : Either registration window " +
                              "is closed, or maximum number of participants have already registered!");
                      })
                  @endif
              });
          </script>
          @include('tournaments.tournament_overview')
          @include('tournaments.tournament_info')
          @include('tournaments.tournament_rules')
          @include('tournaments.tournament_teams')
          @include('tournaments.register')

        </div>
        <div class="col-12 col-md-4">
          @if($nextmatch)
          <div class="mt-4 card-body card-title">
            <span class="font-primary font-white text-uppercase">Next Match</span>
          </div>
          <div class="row justify-content-center mt-4">

            <div class="col-5">
              <div class="card bg-transparent team-logo-300-trans">
                <img class="card-img-top" src="{{$nextmatch->contestants[0]->contending_team->logo_size1}}" alt="Esports team {{$nextmatch->contestants[0]->contending_team->name}} {{$nextmatch->contestants[0]->contending_team->tag}}">
              </div>
            </div>
            <div class="col-2 pt-4">
              <h6 class="font-primary-color text-center">vs</h6>
            </div>
            <div class="col-5">
              <div class="card bg-transparent team-logo-300-trans">
                <img class="card-img-top" src="{{$nextmatch->contestants[1]->contending_team->logo_size1}}" alt="Esports team {{$nextmatch->contestants[1]->contending_team->name}} {{$nextmatch->contestants[1]->contending_team->tag}}">
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-3 mb-5">
            <div class="col-5" style="">
              <h5 class="text-center font-white">{{$nextmatch->contestants[0]->contending_team->tag}}</h5>
            </div>
            <div class="col-2">
            </div>
            <div class="col-5" style="">
              <h5 class="text-center font-white">{{$nextmatch->contestants[1]->contending_team->tag}}</h5>
            </div>
          </div>
          @endif
          <div class="mt-4 mb-0 card-body card-title py-3">
            <span class="font-white font-primary text-uppercase">Standings</span>
          </div>
          <div class="card-body justify-content-center bg-purple3 pt-4 mt-0">
            <div class="col-11">
              <table class="table table-sm table-dark">
                <thead class="">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Team</th>
                  <th scope="col">Played</th>
                  <th scope="col">Points</th>
                </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                @if($tournament->standings)
                @foreach($tournament->standings as $record)
                  @php $i++; @endphp
                  <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$record->team_name}}</td>
                    <td>{{$record->mp}}</td>
                    <td>{{$record->points}}</td>
                  </tr>
                @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--<div style="height: 50vh;">--}}

      {{--</div>--}}
    </div>
  </div>
@endsection