<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>pdftk service| Free your PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <section class="hero is-primary">
    <div class="hero-body">
      <p class="title">pdftk service</p>
      <p class="subtitle">
        <strong>Free</strong> your <strong>PDF</strong> 
      </p>
    </div>
    </section>    
    <section class="section">
      <div class="container">
        <div class="columns is-centered is-vcentered">
          <div class="column is-half-desktop">
          <form action="" method="post" enctype="multipart/form-data" class="box mt-6">
          <div class="field">
            <label class="label">Upload & Convert</label>
            Maximum 20MB and only PDF files allowed.
          </div>
          <div id="file-uploader-wrapper" class="field">
            <div id="file-uploader" class="file">
              <label class="file-label">
                <input class="file-input" type="file" name="file">
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span class="file-label">
                    Choose a file…
                  </span>
                </span>
                <span class="file-name is-hidden"></span>
              </label>
            </div>
            <p id="valid-file" class="help is-success is-hidden">File is valid.</p>        
            <p id="invalid-size" class="help is-danger is-hidden">The file is too big. Maximum allowed file size is 20 MB.</p>
            <p id="invalid-type" class="help is-danger is-hidden">The file is of wrong type. Allowed file type is PDF.</p>        
          </div>      
          <div class="field">
            <div class="control">
              <input id="submit-convert" class="button is-primary" type="submit" value="Convert" disabled>
            </div>        
          </div>

          <div class="field">
            <div id="server-error" class="notification is-danger is-hidden"></div>
          </div>

          <div id="progress-bar" class="field is-hidden">
            <div id="progress-status" class="mb-3">Processing..</div>
            <div class="control">
              <progress class="progress is-small is-primary is-light" max="100"></progress>
            </div>
          </div>

          <a id="download-button" href="#download" class="button is-large is-fullwidth is-success is-light is-hidden">Download</a>

        </form>          
          </div>
        </div>

      </div>
    </section>

    <footer class="footer">
      <div class="content has-text-centered">
        <p>
          <strong>pdftk service </strong> by <a href="https://jgthms.com">Ekin Tertemiz</a>. <br>Using pdftk by <a target="_blank" href="https://www.pdflabs.com">PDF Labs</a>. Deployed on <a target="_blank" href="https://heroku.com">Heroku</a>
        </p>
      </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
    <script src="js/main.js"></script>
  </body>
</html>