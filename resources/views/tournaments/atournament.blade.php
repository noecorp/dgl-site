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
      <div class="jumbotron-fluid jumbotron-atournament" style="background-image: url('{{$tournament->banner}}');
                                                                background-position: center">
        <div class="row tournament-name-row pt-5 justify-content-center" style="">
          <div class="col-12">
            <h1 class="display-4 text-center">{{$tournament->name}}</h1>

          </div>
        </div>
        @if($tournament->logo && $tournament->logo_visibility == 'visible')
          <div class="row justify-content-center">
            <img src="{{$tournament->logo}}"}} style="width: 28vw; height: 28vw; max-width: 250px; max-height: 250px; min-width: 150px; min-height: 150px;">
          </div>
        @else
          <div class="aspacer">
          </div>
        @endif
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
        <div class="col-12 col-md-9 main-slot p-4">

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

                  if({{$tournament->registration_active}})
                  {
                    $('#navRegistration').click(function () {
                        $('.nav-link').removeClass('active');
                        $('#navRegistration').addClass('active');
                        $('.tournament-row').hide();
                        $('.register-row').show();
                    });
                  }
                  else
                  {
                      $('#navRegistration').addClass("disabled");
                      $('#navRegistration').click(function () {

                          toastr.options = {
                              "closeButton": true,
                              "timeOut": "8000",
                              "preventDuplicates": true
                          }
                          toastr.error("Too Late. Registration window has closed.");
                      })
                  }
              });
          </script>
          @include('tournaments.tournament_overview')
          @include('tournaments.tournament_info')
          @include('tournaments.tournament_rules')
          @include('tournaments.tournament_teams')
          @include('tournaments.register')

        </div>
        <div class="col-12 col-md-3">
          @if($nextmatch)
          <div class="sidebar-header active mt-4">
            <h5>Next Match</h5>
          </div>
          <div class="row justify-content-center mt-4">

            <div class="col-5">
              <div class="card bg-transparent team-logo-300-trans">
                <img class="card-img-top" src="{{$nextmatch->contestants[0]->contending_team->logo_size1}}" alt="Card image cap">
              </div>
            </div>
            <div class="col-2 pt-4">
              <h6 class="font-primary-color text-center">vs</h6>
            </div>
            <div class="col-5">
              <div class="card bg-transparent team-logo-300-trans">
                <img class="card-img-top" src="{{$nextmatch->contestants[1]->contending_team->logo_size1}}" alt="Card image cap">
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-3">
            <div class="col-5" style="">
              <h5 class="text-center font-white">{{$nextmatch->contestants[0]->contending_team->tag}}</h5>
            </div>
            <div class="col-2" style="border: 1px dashed white;">
            </div>
            <div class="col-5" style="">
              <h5 class="text-center font-white">{{$nextmatch->contestants[1]->contending_team->tag}}</h5>
            </div>
          </div>
          @endif
          <div class="sidebar-header mt-4">
            <h5>Standings</h5>
          </div>
          <div class="row justify-content-center mt-4">
            <div class="col-11">
              <table class="table table-sm table-dark">
                <thead class="thead-dark">
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