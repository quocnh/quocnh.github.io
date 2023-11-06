<h1 id="publications"></h1>

<h2 style="margin: 60px 0px -15px;">Publications <temp style="font-size:15px;">[</temp><a href="https://scholar.google.com/citations?user=yikSJwMAAAAJ&hl=en" target="_blank" style="font-size:15px;">Google Scholar</a><temp style="font-size:15px;">]</temp><temp style="font-size:15px;">


<div class="publications">
<ol class="bibliography">

<h4 style="margin:0 10px 0;">Peer-reviewed Journals</h4>


{% for link in site.data.publications.main %}

<li>
<div class="pub-row">
  <div class="col-sm-3 abbr" style="position: relative;padding-right: 15px;padding-left: 15px;">
    <img src="{{ link.image }}" class="teaser img-fluid z-depth-1" style="width=100;height=40%">
            <abbr class="badge">{{ link.conference_short }}</abbr>
  </div>
  <div class="col-sm-9" style="position: relative;padding-right: 15px;padding-left: 20px;">
      <div class="title"><a href="{{ link.pdf }}">{{ link.title }}</a></div>
      <div class="author">{{ link.authors }}</div>
      <div class="periodical"><em>{{ link.conference }}</em>
      </div>
    <div class="links">
      {% if link.pdf %} 
      <a href="{{ link.pdf }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">PDF</a>
      {% endif %}
      {% if link.code %} 
      <a href="{{ link.code }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">Code</a>
      {% endif %}
      {% if link.page %} 
      <a href="{{ link.page }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">Project Page</a>
      {% endif %}
      {% if link.bibtex %} 
      <a href="{{ link.bibtex }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">BibTex</a>
      {% endif %}
      {% if link.notes %} 
      <strong> <i style="color:#e74d3c">{{ link.notes }}</i></strong>
      {% endif %}
      {% if link.others %} 
      {{ link.others }}
      {% endif %}
    </div>
  </div>
</div>
</li>

<br>

{% endfor %}

<h4 style="margin:0 10px 0;">Peer-reviewed Conferences</h4>

{% for link in site.data.publications_conf.main %}

<li>
<div class="pub-row">
  <div class="col-sm-3 abbr" style="position: relative;padding-right: 15px;padding-left: 15px;">
    <img src="{{ link.image }}" class="teaser img-fluid z-depth-1" style="width=100;height=40%">
            <abbr class="badge">{{ link.conference_short }}</abbr>
  </div>
  <div class="col-sm-9" style="position: relative;padding-right: 15px;padding-left: 20px;">
      <div class="title"><a href="{{ link.pdf }}">{{ link.title }}</a></div>
      <div class="author">{{ link.authors }}</div>
      <div class="periodical"><em>{{ link.conference }}</em>
      </div>
    <div class="links">
      {% if link.pdf %} 
      <a href="{{ link.pdf }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">PDF</a>
      {% endif %}
      {% if link.code %} 
      <a href="{{ link.code }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">Code</a>
      {% endif %}
      {% if link.page %} 
      <a href="{{ link.page }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">Project Page</a>
      {% endif %}
      {% if link.bibtex %} 
      <a href="{{ link.bibtex }}" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">BibTex</a>
      {% endif %}
      {% if link.notes %} 
      <strong> <i style="color:#e74d3c">{{ link.notes }}</i></strong>
      {% endif %}
      {% if link.others %} 
      {{ link.others }}
      {% endif %}
    </div>
  </div>
</div>
</li>

<br>

{% endfor %}

<li>
<div class="pub-row">
  <div class="col-sm-3 abbr" style="position: relative;padding-right: 15px;padding-left: 15px;">
    <img src="https://img.yliu.me/teaser/MTL_CVPR.png" class="teaser img-fluid z-depth-1">
            <abbr class="badge">CVPR</abbr>
  </div>
  <div class="col-sm-9" style="position: relative;padding-right: 15px;padding-left: 20px;">
      <div class="title"><a href="https://doi.org/10.1109/ICUFN.2015.7182665">Low cost real-time system monitoring using Raspberry Pi</a></div>
      <div class="author"><strong>Quoc H. Nguyen*</strong>, Ton Thi Kim Loan, Bui Dinh Mao, Eui-Nam Huh</div>
      <div class="periodical"><em>2015 The 7th IEEE International Conference on Ubiquitous and Future Networks (ICNGC), Sapporo, Japan.</em>
      </div>
    <div class="links">
      <a href="https://quocnh.github.io/assets/publications/2016_icufn/paper.pdf" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">PDF</a>
      <a href="https://doi.org/10.1109/ICUFN.2015.7182665" class="btn btn-sm z-depth-0" role="button" target="_blank" style="font-size:12px;">Project Page</a>
<br>
<strong> <a style="color:#e74d3c; font-weight:600" href="https://scholar.google.com/citations?view_op=view_citation&hl=en&user=yikSJwMAAAAJ&citation_for_view=yikSJwMAAAAJ:tOudhMTPpwUC"><i id="total_citation_mtl">100+</i><i style="color:#e74d3c; font-weight:600"> Citations 
<br>
  <script>
  githubStars("yaoyao-liu/meta-transfer-learning", function(stars) {
  var startext = document.getElementById("githubstars_mtl");
        startext.innerHTML=stars;
  });
  </script>
  <script>
      $(document).ready(function () {
          
          var gsDataBaseUrl = 'https://raw.githubusercontent.com/quocnh/quocnh.github.io/'
          
          $.getJSON(gsDataBaseUrl + "google-scholar-stats/gs_data.json", function (data) {
              var totalCitation = data['publications']['Uf9GqRsAAAAJ:bEWYMUwI8FkC']['num_citations']
              document.getElementById('total_citation_mtl').innerHTML = totalCitation;
              var citationEles = document.getElementsByClassName('show_paper_citations')
              Array.prototype.forEach.call(citationEles, element => {
                  var paperId = element.getAttribute('data')
                  var numCitations = data['publications'][paperId]['num_citations']
                  element.innerHTML = '| Citations: ' + numCitations;
              });
          });
      })
  </script>
    </div>
  </div>
</div>
</li>

</ol>
</div>


