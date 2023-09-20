<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/style.css">
    <title>Carousel Slider</title>
  </head>
  <body style="background: orange;">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
      </ol>

      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image:url(assets/STL.jpg);">
          <div class="container" style="padding-left: 150px; padding-right: 150px; background-color: rgba(0, 0, 0, 0.35);">
              <h1>Digital Library</h1>
              <p>Hop in our digital virtual library to find the book you're looking for!</p>
              <a href="smart-library" class="btn btn-lg btn-primary" role="button"target="_blank">Browse</a>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/findBook.jpg);">
          <div class="container" style="padding-left: 150px; padding-right: 150px; background-color: rgba(0, 0, 0, 0.35);">
            <h1>Locate A Book</h1>
            <p>Specifically search here for a book if you know the book's call number(ID)!</p>
            <a href="index-dynamic-carousel.php" class="btn btn-lg btn-primary" role="button">Search</a>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/traffic.jpg);">
          <div class="container" style="padding-left: 150px; padding-right: 150px; background-color: rgba(0, 0, 0, 0.35);">
            <h1>Traffic Analysis</h1>
            <p>See how busy Sojourner Truth is at different hours of the Day!</p>
            <a href="https://cs.newpaltz.edu/p/f22-04/v2/index.php" class="btn btn-lg btn-primary" role="button" target="_target">See Now</a>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/robot.jpg);">
          <div class="container" style="padding-left: 150px; padding-right: 150px; background-color: rgba(0, 0, 0, 0.35);">
            <h1>Robot</h1>
            <p>Coming Soon!</p>
            <a href="index-coming-soon.php" class="btn btn-lg btn-primary" role="button">Check it Out</a>
          </div>
        </div>
      </div>

      <a href="#myCarousel" class="carousel-control-prev" role="button" data-slide="prev">
        <span class="sr-only">Previous</span>
        <span class="carousel-control-prev-icon" arial-hidden="true"></span>
      </a>
      <a href="#myCarousel" class="carousel-control-next" role="button" data-slide="next">
        <span class="sr-only">Next</span>
        <span class="carousel-control-next-icon" arial-hidden="true"></span>
      </a>
  </div>
  
  <div>
    <br>
    <center>
      <ul class="list-group list-group-flush">
        <li class="list-group-item" style="background: orange;"><marquee behavior="scroll" direction="left"><h2 style="font-weight: bold;">Welcome to the Digital Library Web App!</h2></marquee></li>
        <br>
        <li class="list-group-item" style="background: orange;"><h4>This is a portal for users to be able to navigate the Sojourner Truth Library on a web based application.</h4></li>
        <li class="list-group-item" style="background: orange;">
    </center>
          <table class="table">
            <tbody style="margin: auto;">
              <tr style="margin: auto;">
                <td style="margin: auto;">
                  <div class="card" style="width:; background: grey; color: white; margin: auto;">
                    <div class="card-header"><h5 style="font-weight: bold;">Developed By:</h5></div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item bg-primary" style="color: white;"><p style="font-weight: bold;">Smart Library: </p><p style="color: orange;"> Noah Franklin, Alexandra Maceda <br> and Yitzhak Alvarez</p></li>
                      <li class="list-group-item bg-primary" style="color: white;"><p style="font-weight: bold;">Book Locator:</p><p style="color: orange;"> Anthony DiNardi </p></li>
                      <li class="list-group-item bg-primary" style="color: white;"><p style="font-weight: bold;">Traffic analysis:</p><p style="color: orange;">Gene Baybay and Cameron Dyas</p></li>
                      <li class="list-group-item bg-primary" style="color: white;"><p style="font-weight: bold;">Robot:</p><p style="color: orange;"> Brian Praise and Wesley Cartagena</p></li>
                      <li class="list-group-item bg-primary" style="color: white;"><p style="font-weight: bold;">Portal:</p><p style="color: orange;"> Luc Caccioppoli</p></li>
                    </ul>
                  </div>
                </td>                
                <td style="margin: auto;">
                  <div class="card" style="width:; background: grey; color: white;">
                    <div class="card-header"><h5 style="font-weight: bold;">Other Links:</h5></div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item bg-primary" style="color: white;"><a class="btn btn-primary" href="https://www.newpaltz.edu/" role="button" target="_target">SUNY New Paltz Website</a></li>
                      <li class="list-group-item bg-primary" style="color: white;"><a class="btn btn-primary" href="https://library.newpaltz.edu/" role="button" target="_target">Sojourner Truth Library Website</a></li>
                      <li class="list-group-item bg-primary" style="color: white;"><a class="btn btn-primary" href="https://login.microsoftonline.com/ebd45737-b352-4722-bb0c-9f539bcbfa65/saml2?SAMLRequest=fZJNb9swDIbv%2BxWGroVtWbbjRIgdZCuKBci2oEl32KWQZLoVYEuZKafdfv38kWINCuQoii%2F5kC%2BXq9em9k7QorYmJ1FAiQdG2VKbp5w8HO78OVkVn5Yompod%2Bbpzz%2BYefneAzlsjQut63RdrsGug3UN70goe7rc5eXbuiDwMa%2FukTWDg5Shq9zeAsguVwCm8UrUG4x6NaCD%2FDi83uyHnZjv8EW%2FtXKtl52Aq3wOd629MCa856UlvewxthBvZLzs2WrUWbeWsqbWBQNkmBFkmaRZnvoxT5icZY76UVPmLKo0XUslKzNJwnJR4d7ZVMI6bk0rUCMTb3ObkMSkhljLKKJulCWOZrOYykjNYRAsFSZIBndNy3rNtcCcQ9Qn%2B6xG7Hh6dMC4njLLIjyI%2FpgfKeDTnlAYRjX8Rb9daZ5WtP2sz2dC1hluBGvmwKeRO8f3625azgHI5JSH%2Fejjs%2FN2P%2FYF4P9%2FsZIOdvcEG%2BWTg9VrHc2NSTH7zkbgddtEId107RHTpV2Mq713V7s9F7%2Bty8XZLpBjSGqFglPGP97MM38MV5%2BflbRb%2FAA%3D%3D&RelayState=TST-58330-LG8AO5PgnFg5v5dHWE57xIY-BpyVarLV&sso_reload=true" role="button" target="_target">My NewPaltz</a></li>
                      <li class="list-group-item bg-primary" style="color: #0d6efd;"><p>This Is A</p></li>
                      <li class="list-group-item bg-primary" style="color: #0d6efd; height: 284.82px;"><p>Secret Message</p></li>
                    </ul>
                  </div>
                </td>  
              </tr>
            </tbody>
          </table>
          
        </li>
        <li class="list-group-item" style="background: orange;"></li>
      </ul>
  </div>
  
  <script src= "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity= "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src= "https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity= "sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  
  </body>
</html>
