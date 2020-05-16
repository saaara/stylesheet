                function getpage(page)
				{
					var Xreq = new XMLHttpRequest();
					Xreq.onreadystatechange = function()
					{
						if(this.readyState < 4 )
						{
							document.getElementById('loader').innerHTML = '<i class="fa fa-sign-in fa-spin fa-5x fa-fw"></i>';
						}
						else if(this.readyState == 4  & this.status == 200)
						{
							document.getElementById('cont').innerHTML = this.responseText;
						}
					}
					Xreq.open("GET",page,true);
					// Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
				    Xreq.send();
				}

				function valid(key)
				{
					var email = document.forms["signup"]["mail"].value ;
					var name = document.forms["signup"]["name"].value ;
					var pass = document.forms["signup"]["userpass"].value ;
					var Xreq  = new XMLHttpRequest();
					Xreq.onreadystatechange = function()
					{
						if(this.readyState < 4 )
						{  
							document.getElementById('loader').innerHTML = '<button class="login-btn disabled" disabled="disabled"> <i class="fa fa-spinner fa-spin fa-fw"></i> التسجيل </button>';
						}
						else if(this.readyState == 4  & this.status == 200)
						{
							document.getElementById('loader').innerHTML = this.responseText;
							
						}
					}
					Xreq.open("GET",'core/validation.php?mail='+email+'&name='+name+'&pass='+pass+'&key='+key,true);
					// Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
				    Xreq.send();
				}

				function login()
				{
					var email = document.forms["signin"]["mail-user"].value ;
					var pass = document.forms["signin"]["userpass"].value ;
					var Xreq  = new XMLHttpRequest();
					Xreq.onreadystatechange = function()
					{
						if(this.readyState < 4 )
						{  
							document.getElementById('loader').innerHTML = '<button class="login-btn disabled" disabled="disabled"> <i class="fa fa-spinner fa-spin fa-fw"></i> تسجيل الدخول </button>';
						}
						else if(this.readyState == 4  & this.status == 200)
						{
							document.getElementById('loader').innerHTML = '<button class="login-btn" onclick="login()" > تسجيل الدخول </button>';
							document.getElementById('status').innerHTML = this.responseText;
							
						}
					}
					Xreq.open("GET",'core/validation.php?mail='+email+'&pass='+pass+'&rqst=login',true);
					// Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
				    Xreq.send();
				}

				function bookview(uid,pid,slink)
				{
					var Xreq  = new XMLHttpRequest();
					Xreq.onreadystatechange = function()
					{
						if(this.readyState < 4 )
						{  
							document.getElementById('bk').innerHTML = '<button> <i class="fa fa-spinner fa-spin fa-fw"></i> </button>';
						}
						else if(this.readyState == 4  & this.status == 200)
						{
							document.getElementById('bk').innerHTML = this.responseText;
							
						}
					}
					Xreq.open("GET",'core/validation.php?key=book&uid='+uid+'&pid='+pid,true);
					// Xreq.setrequestheader("content-type","application/x-www-form-urlencoded") for the post method
				    Xreq.send();
				}