<head>
  <link href="./dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lucaburgio/iconoir@main/css/iconoir.css">
  <link rel="preconnect" href="https://fonts.gstatic.com"> 
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
  <link href="styleindex.css" rel="stylesheet">
  <title>YouTube Manager</title>
</head>
<html>
<body>
  <div>

  <section class="relative bg-blueGray-50 test">
    <div class="relative pt-16 pb-32 flex content-center items-center justify-center min-h-screen-75">
            <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
                background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1267&amp;q=80');
              ">
              <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
            </div>
            <div class="container relative mx-auto">
              <div style="margin-left: 62.5%; margin-top: -40px">
                <a class="text-white langage" href="../index.php">FR</a>
                <br> 
                <a class="text-white langage" href="eng/index.php">ENG</a>      
              </div>
              <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                  <div class="pr-12">
                    <h1 class="text-5xl font-extrabold text-transparent bg-clip-text text-white titre">
                      YouTube Manager
                    </h1>
                    <p class="mt-4 text-lg text-white">
                      Gérer votre chaine YouTube plus précisemment
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden h-70-px" style="transform: translateZ(0px)">
              <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-blueGray-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
              </svg>
            </div>
          </div>
          <section class="pb-10 bg-blueGray-200 -mt-24">
            <div class="container mx-auto px-4">
              <div class="flex flex-wrap">
                <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto glassmorph">
                      <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-red-400">
                        <i class="iconoir-pin-alt"></i>
                      </div>
                      <br>
                      <span class="text-m font-semibold span1"><a href="geolocation_search.php"> Recherche Géolocalisée  </a></span>
                        <br>
                      <p class="mt-2 mb-4 text-blueGray-500">
                        Trouver des vidéos fais par vos concurrents.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto glassmorph">
                      <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-lightBlue-400">
                        <i class="iconoir-media-video" style="color: black;"></i>
                      </div>
                      <br>
                      <a href="my_uploads.php" class="text-xl font-semibold span1">Mes vidéos</a>
                      <br>
                      <p class="mt-2 mb-4 text-blueGray-500">
                        Voir la liste de vos vidéos YouTube
                      </p>
                    </div>
                  </div>
                </div>
                <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                  <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                    <div class="px-4 py-5 flex-auto glassmorph">
                      <div class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full bg-emerald-400">
                        <i class="iconoir-add-media-image"></i>
                      </div>
                      <a href="upload_thumbnail.php" class="text-xl font-semibold span1 nowrap -mt-2 pb-2 ">Mettre à jour mes miniatures</a>
                        
                      <p class="mt-8 mb-4 text-blueGray-500">
                        Mettre à jour ses miniatures plus rapidement sans passer par YouTube.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
  </section>
  
  <div class="pricing">
    <div class="min-h-screen flex justify-center items-center">
        <div class="">
            <div class="text-center font-semibold relation">
                <h1 class="text-5xl">
                    <span class="text-red-600 tracking-wide">Facilitez </span>
                    <span>la gestion de votre chaine</span>
                    <img src="images/blob.svg" alt="blobrouge" class="blobrouge absolute">
                    <img src="images/blob2.svg" alt="blobrouge" class="blobrouge2 absolute">
                </h1>

                <p class="pt-6 text-xl text-gray-400 font-normal w-full px-8 md:w-full">
                    Prenez le plan qui vous correspond le mieux.
                </p>
            </div>
            <div class="pt-24 flex flex-row" id="indexhaut">
                <!-- Basic Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pr-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Starter</h1>

                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">$ </span>
                        <span class="text-3xl font-semibold">2</span>
                        <span class="text-gray-400 font-medium">/ an</span>
                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Supprimer les <span class="text-black">publicités</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Modifier vos vidéos <span class="text-black">en ligne</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-black">1 TB</span> de stockage dans le cloud
                            </span>
                        </p>

                        <a href="configpay.php" class="">
                            <p class="w-full py-4 bg-red-600 mt-8 rounded-xl text-white augmentation">
                                <span class="font-medium">
                                    Choisir
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
                <!-- StartUp Card -->
                <div class="w-80 p-8 bg-gray-900 text-center rounded-3xl text-white border-4 shadow-xl border-white transform scale-125">
                    <h1 class="text-white font-semibold text-2xl">Pro</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">$ </span>
                        <span class="text-3xl font-semibold">5</span>
                        <span class="text-gray-400 font-medium">/ an</span>
                    </p>
                    <hr class="mt-4 border-1 border-gray-600">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Toutes les fonctionnalités <span class="text-gray-900 select-none">yooooooooo</span><span class="text-white">Starter</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Résolution <span class="text-white">maximale</span> lors de <span class="text-gray-900 select-none">yoooo</span> l'upload des vidéos
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                <span class="text-white">5 TB</span> de stockage dans le <span class="text-gray-900 select-none">yooooooooo</span> cloud
                            </span>
                        </p>

                        <a href="configpay2.php" class="">
                            <p class="w-full py-4 bg-red-600 mt-8 rounded-xl text-white augmentation">
                                <span class="font-medium">
                                    Choisir
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                    <div class="absolute top-4 right-4">
                        <p class="bg-blue-700 font-semibold px-4 py-1 rounded-full uppercase text-xs">Meilleur Choix</p>
                    </div>
                </div>
                <!-- Enterprise Card -->
                <div class="w-96 p-8 bg-white text-center rounded-3xl pl-16 shadow-xl">
                    <h1 class="text-black font-semibold text-2xl">Pro +</h1>
                    <p class="pt-2 tracking-wide">
                        <span class="text-gray-400 align-top">$ </span>
                        <span class="text-3xl font-semibold">10</span>
                        <span class="text-gray-400 font-medium">/ an</span>
                    </p>
                    <hr class="mt-4 border-1">
                    <div class="pt-8">
                        <p class="font-semibold text-gray-400 text-left">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Toutes les fonctionnalités <span class="text-black">Pro</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Programmez la sortie de vos <span class="text-white">yoooo</span> vidéos <span class="text-black">automatiquement</span>
                            </span>
                        </p>
                        <p class="font-semibold text-gray-400 text-left pt-5">
                            <span class="material-icons align-middle">
                                done
                            </span>
                            <span class="pl-2">
                                Stockage dans le cloud <span class="text-black">Illimité</span>
                            </span>
                        </p>

                        <a href="configpay3.php" class="">
                            <p class="w-full py-4 bg-red-600 mt-8 rounded-xl text-white augmentation">
                                <span class="font-medium">
                                    Choisir
                                </span>
                                <span class="pl-2 material-icons align-middle text-sm">
                                    east
                                </span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

</body>

<br>
<br>

<footer class="annul pt-8 pb-6" style="background-color: rgb(248 250 252); margin-top: 50px;">
  <div class="ml-2">
    <div class="flex flexeurfou">
      <div class="w-full lg:w-6/12 px-4">
        <h4 class="text-3xl fonat-semibold text-blueGray-700">Restons en <span class="text-red-600">contact</span> !</h4>
        <h5 class="text-lg">
          N'hésitez pas à consulter ma chaine YouTube
        </h5>
        <br>
          <div class="flexing" style="display: flex;">
          <div class="footergauche">
            <a href="add_subscription.php" class="boutonblanc" style="border-radius: 15px;
                  border-color: #fa0000;
                  background-color: #fa0000;
                  padding: 5px 5px 5px 5px ;
                  color: white;
                  font-weight: bolder;
                  letter-spacing: 0.5px;
                  vertical-align: middle;
                  white-space:nowrap">
                  Roman Germain          
            </a>
          </div>
          <div class="footerdroite" style="padding-top: 0px;">
          <svg width="24px" height="24px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#DC2626" style="margin-left: 10px;">
            <path d="M14 12l-3.5 2v-4l3.5 2z" fill="#000000" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            </path>
            <path d="M2 12.707v-1.415c0-2.895 0-4.343.905-5.274.906-.932 2.332-.972 5.183-1.053C9.438 4.927 10.818 4.9 12 4.9c1.181 0 2.561.027 3.912.065 2.851.081 4.277.121 5.182 1.053.906.931.906 2.38.906 5.274v1.415c0 2.896 0 4.343-.905 5.275-.906.931-2.331.972-5.183 1.052-1.35.039-2.73.066-3.912.066-1.181 0-2.561-.027-3.912-.066-2.851-.08-4.277-.12-5.183-1.052C2 17.05 2 15.602 2 12.708z" stroke="#000000" stroke-width="1.5">
            </path>
          </svg>  
          </div>
        </div>
      </div>
      
      <div class="enlevage">
        <div class="margegauche ml-8">
            <div class="flex flexeurfou">
              <div class="w-full">
                <span class="uppercase text-red-600 text-sm font-semibold mb-2"> Mes Liens</span>
                <ul class="list-unstyled">
                  <li>
                    <a class="text-blueGray-600 hover:text-blueGray-800 font-semibold block pb-2 text-sm" href="https://github.com/Niamreg76">Github</a>
                  </li>
                </ul>
              </div>
              <div class="pl-8 test1">
                <span class="uppercase text-red-600 text-sm font-semibold mb-2">Autres ressources</span>
                <ul class="list-unstyled">
                  <li>
                    <a class="font-semibold text-sm" href="terms.html">Conditions d'utilisations</a>
                  </li>
                  <li>
                    <a class="font-semibold text-sm" href="politique.html">Politique de confidentialité</a>
                  </li>
                  <li>
                    <a class="font-semibold text-sm" href="https://www.linkedin.com/in/roman-germain-283600227/">Me contacter</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>        
      </div>
  
    <hr class="my-6 border-blueGray-300 mt-8">
    <div class="flex flex-wrap items-center md:justify-between justify-center">
      <div class="w-full md:w-4/12 px-4 mx-auto text-center">
        <div class="text-sm text-blueGray-500 font-semibold py-1">
          Copyright © <span id="get-current-year">2023</span class="text-blueGray-500 hover:text-gray-800" target="_blank">
          <a href="" class="text-blueGray-500 hover:text-blueGray-800">Roman Germain</a>.
        </div>
      </div>
    </div>
  </div>
</footer>

</html>

<style>
      .boutonblanc:hover{
        color: #fa0000;
        background-color: white;
        vertical-align: middle;
        border: 1.6px solid #fa0000;
    }
    fa {
    color: white;
  }
  
  fa:hover{
    color:#fa0000;
  }
  .langage:hover{
    scale: 1.5;
    color: red;
  }

  .augmentation:hover{
    scale: 1.05;
  }

  .enlevage{
    margin-left: 455px;
  }
  @media only screen and (max-width: 991px) {
  .pricing{
    display: flex;
    flex-direction: column;
    scale: 0.8;
  }
  .margegauche{
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    max-width: 500px;
  }
  .flexeurfou{
    display: flex;
    flex-direction: column;
  }
  .enlevage{
    margin-left: 0;
  }
  .margegauche{
    margin-left: 0;
  }
  .test{

  }

}
  @media only screen and (max-width: 767px) {
    .pricing{
      scale: 0.6;
    }
  }
  @media only screen and (max-width: 655px) {
    .pricing{
      scale: 0.5;
      margin-top: -200px;
      margin-bottom: -200px;
    }
    .blobrouge2, .blobrouge{
      display: none;
    }
  }
</style>