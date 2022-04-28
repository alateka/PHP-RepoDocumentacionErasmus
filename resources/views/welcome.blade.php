@extends('layouts.layout')

@section('title', 'Bienvenido a Erasmus +')

@section('content')
<div class="sect sect--padding-top">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
      <div class="site">
        <h1 class="site__title">Bienvenido a Erasmus +</h1>
        <h2 class="site__subtitle">Vive una experiencia única</h2>
        <div class="site__box-link justify-content-center">
          <a class="btn btn--active" href="{{ route('register') }}">Regístrate ya</a>
        </div>
        <img class="site__img" src="{{asset('img/fondo.jpg')}}">
      </div>
      </div>
      </div>
    </div>
  </div>

  <div class="container">
  <div class="row row--center">
    <h1 class="row__title">
      Secciones
    </h1>
  </div>
  <section id="team" class="">
    <div class="container">
        <div class="row">
            <!-- Inicio de la tarjeta -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid faq-img" src="{{asset('img/faq2.png')}}" alt="card image"></p>
                                    <h3 class="card-title">Información</h3>
                                    <a href="" class="btn btn--active btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h3 class="card-title"> <strong> Preguntas frecuentes e información </strong></h3>
                                    <p>Información y preguntas frecuentes relacionadas con la beca Erasmus+</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('info.faq')}}" class="btn btn--active d-block">Ver información</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de tarjeta -->

            <!-- Inicio de tarjeta -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid docs-img" src="{{asset('img/doc.png')}}" alt="card image"></p>
                                    <h4 class="card-title">Documentación necesaria</h4>
                                    <a href="" class="btn btn--active btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h3 class="card-title"> <strong> Documentación necesaria </strong></h3>
                                    <p>Toda la documentación y formularios necesarios para solicitar su beca Erasmus+</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('info.documentos')}}" class="btn btn--active d-block">Ver documentación</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de la tarjeta -->

             <!-- Inicio de la tarjeta -->
             <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card border">
                                <div class="card-body text-center">
                                    <p><img class=" img-fluid docs-img" src="{{asset('img/list.png')}}" alt="card image"></p>
                                    <h4 class="card-title">Listados</h4>
                                    <a href="" class="btn btn--active btn-sm"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="card-body text-center mt-4">
                                    <h3 class="card-title"> <strong> Listados de años anteriores </strong></h3>
                                    <p>Listados provisionales y definitivos de años anteriores.</p>
                                </div>
                                <div class="card-footer">
                                    <a href="{{route('info.listados')}}" class="btn btn--active d-block">Ver listados</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de tarjeta -->
        </div>
    </div>
</section>
  </div>

  <div class="sect sect--padding-bottom mb-5">
    <div class="container">
    <div class="row row--center">
      <h1 class="row__title mb-5">
        Enlaces de interés
      </h1>
    </div>
      <div class="row justify-content-center">
        <a href="{{asset('info/docs/Calendario_ProgramaErasmus_20-21.docx.pdf')}}" target="_blank" class="btn btn--active m-1">Calendario del programa Erasmus+</a>
        <a href="http://www.sepie.es" target="_blank" class="btn btn--active m-1">Página web Sepie</a>
        <a href="http://www.sepie.es/formacion-profesional/index.html" target="_blank" class="btn btn--active m-1">Página web Sepie de formación profesional.</a>
      </div>
    </div>
    </div>
  
  <div class="row row--center">
    <h1 class="row__title mb-5">
        Redes sociales</h1>
  </div>
  
  <div class="sect sect--white sect--no-padding">
  <div class="container">
    <div class="row row--center">
      <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/mOtHRw/fblogo.png">
        </a>
      </div>
      
  <div class="col-md-3  col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/nfpXRw/twitterlogo.png">
        </a>
      </div>
      
      
  <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/imgOYb/googlelogo.png">
        </a>
      </div>
      
  <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/ebGAeG/dribbblelogo.png">
        </a>
      </div>
          
      
    </div>
    <div class="row row--center">
      <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/npV8Yb/gitlogo.png">
        </a>
      </div>
      
          <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/cGyZ6w/stacklogo.png">
        </a>
      </div>
      
      
          <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/ij03zG/inlogo.png">
        </a>
      </div>
      
          <div class="col-md-3 col-xs-6 col-sm-6 partner">
        <a href="#" class="partner__link">
        <img class="partner_img" src="https://image.ibb.co/ekqdzG/codepenlogo.png">
        </a>
      </div>
    </div>
  </div>    
  </div>
  
  <div class="sect sect--padding-bottom">
    <div class="container">
      <div class="row row--center">
       <h1 class="row__title">
      Contacto </h1>
      </div>
      <div class="row row--margin">
        <div class="col-md-1"></div>
        <div class="col-md-4">
          <div class="contacts">
            <a href="#" class="contacts__link"><img style="width: 120px" src="{{asset('img/logoingeniero.png')}}"><h1 class="contacts_title-ag">IES Cierva</h1></a>
            <p class="contacts__address">
                C/Iglesia, s/n<br>
                30012 Patiño (Murcia)<br>
              España
            </p>
            <p class="contacts__info">
              Teléfono: <a href="#" class="contacts__info-link"> 968 26 69 22</a>
            </p>
            <p class="contacts__info">
              Email: <a href="#"class="contacts__info-link">30010978@murciaeduca.es</a>
            </p>
            <p class="contacts__info">
              Web: <a href="https://www.iescierva.net/" target="_blank" class="contacts__info-link">Iescierva.net</a>
            </p>
            <p class="contacts__info">
              Moodle: <a href="https://moodle.iescierva.net/" target="_blank" class="contacts__info-link">Moodle.iescierva.net</a>
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <form id="contact" class="form">
            <div class="form-group">
              <select class="form__field form__select">
                <option selected value>Asunto*</option>
                <option value=1>Consulta</option>
                <option value=2>Otros</option>
              </select>
              </div>
             <div class="form-group">
               <div class="form__field--half">
              <input type="text" placeholder="Nombre*" class="form__field form__text"></input>
               </div>
            <div class="form__field--half">
            <input type="text" placeholder="Apellidos" class="form__field form__text"></input>
            </div>
            </div>
        
          <div class="form-group">
            <div class="form__field--half">
              <input type="text" placeholder="Correo electrónico*" class="form__field form__text"></input>
            </div>
           <div class="form__field--half">
            <input type="text" placeholder="Teléfono" class="form__field form__text"></input>
      </div>
            </div>
    
            <div class="form-group">
              <textarea type="text" placeholder="Introduzca su mensaje*" class="form__field form__textarea"></textarea>
              <button class="btn btn--up btn--width" type="submit">Enviar</button>
            </div>
          </form>
        </div>   
  <div class="col-md-1"></div>
      </div>
    </div>
  </div>
  
  <div class="sect sect--violet ">
    <img src="https://image.ibb.co/fWyVtb/path3762.png" class="career-img">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="career_title">¿Alguna duda pendiente?</h1>
          <h1 class="career_sub">Visite nuestra web oficial y resuélvala</h1>
          <a href="https://ec.europa.eu/programmes/erasmus-plus/node_es" target="_blank" class="btn btn--white btn--width">Visitar</a>
        </div>
      </div>
    </div>
    
  </div>
@endsection

@section('js')
    
@endsection