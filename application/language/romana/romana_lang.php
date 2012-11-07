<?php
$lang['full_name'] ="Numele Complet";
$lang['email_address']="Adresa E-mail";
$lang['group'] = "Nume Grup";
$lang['password']="Parola";
$lang['conf_password']="Confirma Parola";
$lang['message']="Mesaj";

//form errors messages
$lang['valid_email'] = "%s trebuie sa contina E-mail valid !";
$lang['matches']     = "%s nu se potriveste cu Confirma Parola !";
$lang['required']    = "%s este obligatoriu !";
$lang['gt0']         = "%s trebuie sa fie mai mare decat 0 !";
$lang['numeric']     = "%s trebuie sa contina numai cifre !";
$lang['min_length']  = "%s trebuie sa fie mai mare decat 3!";


$lang['login']=array(
                'buttons'=>array('email_placeholder'=>'Adresa E-mail : IonGrig@gmail.com',
                                 'password_placeholder'=>'Parola : ****',
                                 'conf_password_placeholder'=>'Confirma Parola : ****',
                                 'but1'=>'Pastreaza-ma Logat',
                                 'but2'=>'Autentificare',
                                 'but3'=>'Creaza Cont Gratis',
                                 'but4'=>'Ai uitat parola ?',
                                 'but5'=>'Reseteaza Parola',
                                ),
                'create_account'=>array('full_name'=>'Nume Complet : nume , prenume',
                                        'wrong_domain'=>'Adresa de E-mail are domeniu gresit'),
                'forgot_password'=>array('info'=>' &raquo; Adauga adresa de E-mail si primesti parola noua prin E-mail!'),
                'contact'=>array('info'=>'Daca aveti intrebari sau probleme, nu ezitati , trimiteti-ne  detaliile prin acest formular',
                                 'button'=>'Trimite',
                                 'h1'=>'Contacteazane',
                                 
                                 'full_name'=>'Nume Complet : nume , prenume',
                                 'text' => 'Messaj : Adauga aici detaliile problemei tale',
                                 'reset'=>'Reseteaza cuvantul',
                                 'insert'=>'Introdu cuvantul de deasupra'
                    ),
                'success'=>'Datele au fost salvate cu succes',
                'success1'=>'Te-ai autentificat cu succes !',
                'success2'=>'Contul a fost activat cu succes !',
                'check'=>', verifica emailul',
                'activate'=>' , ca sa activezi contul',
                'error'=>'Eroare !',
                'error1'=>'Aceste date nu au fost gasite !',
                'error2'=>'Verifica E-mailul sa activezi contul sau contul tau a fost suspendat !',
                'page'=>array(
                                'about'=>'Despre noi',
                                'howItWork'=>'Cum Functioneaza ?',
                                'p'=>'Sisteme implementate :',
                                'li1'=>'Sistem de creare test',
                                'li2'=>'Sistem de vizualizare test',
                                'li3'=>'Sistem de editare test',
                                'li4'=>'Sistem de validare teste trimise ',
                                'li5'=>'Sistem de membri',
                                'li6'=>'Sistem de trimis E-mail individual',
                                'li7'=>'Sistem de trimis E-mailuri multiple',
                                'li8'=>'Sistem de verificare top  teste ',
                                'back'=>'Inapoi la inceput',
                                'copyright'=>'Toate drepturile rezervate.'
                )
);

//formular cumparare emailuri
$lang['EmailsNumber'] = 'Total E-mailuri';
$lang['CardExpirationMonth'] = 'Expirare card Luna';
$lang['CardExpirationYear'] = 'Expirare card An';

//meniu and general interface 
$lang['menu'] = array('edit_profile'=>'Setarile Contului',
                      'members'=>'Membri',
                      'your_members'=>'Membrii Tai',
                      'add_member'=>'Adauga Membri',
                      'manage_groups'=>'Gestionati Grupurile',
                      'quizzes'=>'Teste',
                      'top_quizzes'=>'Top Teste',
                      'your_quizzes'=>'Testele Tale',
                      'add_quiz'=>'Creaza Test',
                      'dashboard'=>'Panou Principal',
                      'how_it_works'=>'Cum Functioneaza',
                      'back'=>'Inapoi',
                      'welcome'=>'Bine ai venit',
                      'logout'=>'Deconetare',
                      'copyright'=>'Toate drepturile sunt rezervate',
                      'created'=>'Creat de',
                      'inbox'=>'Mesaje'
);

// dashboard
$lang['client_dashboard'] = array(
                "welcome"=>"Bine ai venit pe QuizCreator",
                "email_purchased"=>"Total E-mailuri de trimis",
                "emails_sent" =>"Total E-mailuri trimise",
                "members_added"=>"Total Membri adaugati",
                "groups_added"=>"Total Grupuri adaugate",
                "quizzes_added"=>"Total Teste adaugate",
                "order_emails"=>"Comanda E-mailuri",
                "info"=>array("h3"=>"Comanda E-mailuri &raquo; Toate campurile cu * sunt obligatorii !",
                              "price"=>"1 E-mail = 0.3 USD",
                              "l1"=>"&raquo; Click pe +/-  sau scrie numarul ca sa adaugi E-mailuri",
                              "l2"=>"&raquo; Al doi-lea formular este pentru datele card de credit"
                              ),
                "form"=>array("total_emails"=>"Total E-mailuri",
                              "total_price"=>"Total pret",
                              "card_nr"=>"Numar card",
                              "cvc"=>"CVC",
                              "expiration"=>"Expirare Card",
                              "tooltip1"=>"Scrie numarul de card (cel de pe fata cardului)",
                              "tooltip2"=>"<u>Scrie ultimile trei cifre</u> <br/> Pe spatele cardului sunt trei cifre<br/> dupa numarul cardului",
                              "tooltip3"=>"Scrie data de expirate a cardului luna/an",
                              "button_order"=>"Trimite Comanda"
                             )
);

//client dashboard colorbox popup - comanda de emailuri
$lang['order_emails'] = array("info"=>array("h3"=>"Comanda E-mailuri &raquo; Toate campurile cu * sunt obligatorii !",
                                            "price"=>"1 E-mail = 0.3 USD",
                                            "l1"=>"&raquo; Click pe +/-  sau scrie numarul ca sa adaugi E-mailuri",
                                            "l2"=>"&raquo; Al doi-lea formular este pentru datele card de credit"),
                                            "total_emails"=>"Total E-mailuri",
                                            "total_price"=>"Total pret",
                                            "card_nr"=>"Numar card",
                                            "cvc"=>"CVC",
                                            "expiration"=>"Expirare Card",
                                            "tooltip1"=>"Scrie numarul de card (cel de pe fata cardului)",
                                            "tooltip2"=>"<u>Scrie ultimile trei cifre</u> <br/> Pe spatele cardului sunt trei cifre<br/> dupa numarul cardului",
                                            "tooltip3"=>"Scrie data de expirate a cardului luna/an",
                                            "button_order"=>"Trimite Comanda"
                            );

//edit client profile
$lang['edit_profile'] =array(
                      'full_name'=>'Schimba Nume Complet',
                      'email_address'=>'Schimba Adresa E-mail',
                      'password'=>'Schimba Parola',
                      'reset_pass_placeholder'=>'Adauga Parola noua (optional)',
                      'emails_permitted'=>'E-mailuri Permise',
                      'emails_sent'=>'E-mailuri Trimise',
                      'error'=>'Nu este nimic de schimbat',
                      'info'=>array("h3"=>"Editeaza Profil &raquo; Toate campurile cu * sunt obligatorii !",
                                    'p'=>'- Daca copletezi campul Reseteaza Parola , parola ta va fi shimbata cu ce ai adaugat.')
);

//your members
$lang['your_members']=array(
                    'info'=>array('h3'=>'Ajutor rapid',
                                  'p1'=>'&raquo; <b>Adauga/Schimba Test</b> - Selecteaza casuta specifica membrului, apoi selecteaza Testul care il vei atribui membrilor selectati',
                                  'p2'=>'&raquo; <b>Adauga/Schimba Grup</b> - Selecteaza casuta specifica membrului, apoi selecteaza Grupul care il vei atribui membrilor selectati',
                                  'p3'=>'&raquo; <b>Trimite la cei selectati</b> - Selecteaza casuta specifica membrului, apoi apasa pe buton pentru a trimite E-mail cu Testul aribuit la toti membrii selectati ',
                                  'p4'=>'- Pentru a seta actiuni la un singur grup , scrie numele grupului in casuta de cautare ',
                                  'tooltip_edit'=>'Editeaza Membru',
                                  'tooltip_delete'=>'Sterge Membru',
                                  'tooltip_quiz_status'=>'Vezi status Teste',
                                  'tooltip_dispatch'=>'Expediaza E-mail'
                                 ),
                    'table'=>array('th1'=>'Grup',
                                   'th2'=>'E-mail',
                                   'th3'=>'Test',
                                   'th4'=>'Trimise',
                                   'th5'=>'Completate',
                                   'th6'=>'Adaugat',
                                   'th7'=>'Actiuni',
                                   'quiz_placeholder'=>'Vizualizeaza test'
                                ),
                    'buttons'=>array('b1'=>'Adauga/Schimba Test',
                                     'b2'=>'Adauga/Schimba Grup',
                                     'b3'=>'Expediere e-mailuri la cei selectati'),
                    'errors'=>array('error'=>'Eroare !',
                                    'noMembers'=>'Nu exista nici un membru , apasa <b>Adauga Membri</b> , pentru a adauga membri !',
                                    'noGroup'=>'Nu exista nici un grupuri !' ,
                                    'success'=>'E-mailul a fost trimis cu succes !',
                                    'delete_success'=>'Datele au fost sterse cu succes !',
                                    'change_quiz'=>'Te rog bifeaza membrii pentru a adauga Testul selectat!',
                                    'change_group'=>'Te rog bifeaza membrii pentru a adauga Grupul selectat!!',
                                    'dispatch_to_all'=>'Te rog bifeaza membrii pentru expediere e-mailuri !',
                                    'dispatch_to_all1'=>'Te rog adauga Test membrilor afisati cu culoare rosie ! ',
                                    'no_quiz'=>'Te rog adauga Test membrului ',
                                    'wrong_domain'=>'Te rog schimba e-mailul membrilor afisati cu culoare rosie, domeniu gresit',
                                    'emails_left'=>' E-mailuri au mai ramas !',
                                    'email_finised'=>'E-mailurile tale s-au terminat ',
                                    'order_emails'=>$lang['client_dashboard']['order_emails'],
                                    
                                    ),
                    'dispatch'=>array('button1'=>'Expediaza',
                                      'button2'=>'Anuleaza',
                                      'title'=>'Expediaza E-mail',
                                      'text'=>'Esti sigur, <br/>ca vrei sa trimiti acest E-mail lui ' 
                                    ),
                    'edit'=>array('h3'=>"Editeaza E-mail &raquo; Toate campurile cu * sunt obligatorii !",
                                  'email_address'=>'Ardesa E-mail' ,
                                  'email_placeholder'=>'IonGrig@gmail.com',
                                  'button'=>'Editeaza',
                                  'error'=>'Adresa de E-mail exista deja !',
                                  'success'=>'Datele au fost salvate cu succes !'
                                ),
                     'deleteMember'=>array('title'=>'Sterge Membru',
                                           'delete_text'=>'Aceste date vor fi sterse si nu pot fi recuperate ! </br> <h3>Esti sigur ?</h3>',
                                           'button1'=>'Sterge',
                                           'button2'=>'Anuleaza'
                     ),
                     'add_members'=>array('info'=>array('h3'=>"Ajutor Rapid &raquo; Toate campurile cu * sunt obligatorii !",
                                                        'p1'=>'&raquo; Selecteaza grupul in care va fi adaugat membrul !',
                                                        'p2'=>'&raquo; Apasa <b>Grup Nou</b> pentru a adauga un grup nou !',
                                                        'p3'=>'&raquo; Pentru a adauga un camp nou <b>Adresa E-mail</b> , apasa + !',
                                                        'p4'=>'&raquo; Pentru a sterge ultimul camp <b>Adresa E-mail</b> , apasa - !'
                                                        ),
                                           'buttons'=>array('button1'=>'Salveaza',
                                                            'button2'=>'Adauga Grup',
                                                            'field1'=>'Nume Grup',
                                                            'field2'=>'Adresa E-mail',
                                                            'field2_placeholder'=>'E-mail: IonGrig@gmail.com',
                                                            'plus_minus_message'=>'Adauga sau sterge Adresa E-mail ',
                                                            'group_name'=>'Nume Grup',
                                                            'select_group'=>'Selecteaza Grup'
                                                            )             
                         ),
                       'manage_groups'=>array('h3'=>'Ajutor Rapid &raquo; Aici poti , edita, sterge, adauga grupuri !',
                                              'th1'=>'Nume Grup',
                                              'th2'=>'Actiuni',
                                              'delete_title'=>'Sterge Grup',
                                              'edit_holder'=>'Editeaza Grup',
                                              'delete_holder'=>'Sterge Grup'
                         )
);

$lang['quiz']= array(
                        'your_quizzes'=>array(
                                                'table'=>array(
                                                    'th1'=>'Nume Test', 
                                                    'th2'=>'Categorie Test',
                                                    'th3'=>'Timp Test',
                                                    'th4'=>'Intrebari',
                                                    'th5'=>'Adaugat',
                                                    'th6'=>'Actiuni',
                                                    'tip_edit'=>'Editeaza Testul',
                                                    'tip_view'=>'Vizualizeaza Testul',
                                                    'tip_del'=>'Sterge Testul',
                                                    'title'=>'Sterge Test',
                                                    'delete_text'=>'Aceste date vor fi sterse si nu pot fi recuperate ! </br> <h3>Esti sigur ?</h3>',
                                                    'button1'=>'Sterge',
                                                    'button2'=>'Anuleaza'
                                                ),
                            ),
                          'create_quiz'=>array(
                              'first'=>array(
                                  'info'=>'Ajutor Rapid &raquo; Toate campurile cu * sunt obligatorii !' ,
                                  'begin'=>'QuizCreator &raquo; Cu noi poti crea si trimite rapid , teste online !',
                                  'opt1'=>'Nume test',
                                  'opt1Tip'=>'Adauga numele preferat Testului',
                                  'opt2'=>'Categorie Test',
                                  'opt2Tip'=>'Adauga Categoria Testului. Acest camp se autocompleteaza, scrie -a-',
                                  'opt3'=>'Numar de intrebari',
                                  'opt3Tip'=>'Selecteaza numarul de intrebari',
                                  'opt4'=>'Numar de raspunsuri pe intrebare',
                                  'opt4Tip'=>'Selecteaza numar de raspunsuri',
                                  'opt5'=>'Adauga timp de completare test (optional)',
                                  'opt5Tip'=>'Timpul actual setat este &raquo;',
                                  'step1'=>'Pasul 1 : ',
                                  'step2'=>'Pasul 2 : ',
                                  'step_name1'=>'Notiuni de baza a testului',
                                  'step_name2'=>'Inrebari &raquo; Raspunsuri',
                                  'step_name3'=>'Finalizare',
                                  'button'=>'Inainte',
                                  'button1'=>'Inapoi'
                               ),
                              'second'=>array(
                                  'info_checkbox'=>'La raspuns multiplu este recomandat sa alegi mai mult de un singur raspuns.<br/>',
                                  'em'=>'Adauga intrebarile si respunsurile apoi bifeaza raspunsul corect :',
                                  'plus'=>'Adauga intrebare',
                                  'minus'=>'Sterge ultima intrebare',
                                  'p_m'=>'Adauga sau sterge intrebare',
                                  'question'=>'Intrebare',
                                  'question_placeholder'=>'Adauga intrebare',
                                  'answer_tooltip'=>'Dublu clic pentu galerie imagini/ Adauga raspuns ',
                                  'settings_tooltip'=>'Setari Intrebare - Seteaza tipul de raspuns sau adauga intrebare cu imagine',
                                  'settings'=>array(
                                      '1'=>'Imagine Intrebare',
                                      '2'=>'Tip Raspuns',
                                      '3'=>'Raspunsuri pe Intrebare',
                                      'question_img_tooltip'=>'Dublu clic pentu galerie imagini (Optional)',
                                      'button'=>'Adauga'
                                  )
                              ),
                              'third'=>array(
                                  'success'=>'Felicitari Testul tau a fost adaugat!',
                                  'error'=>'erroare',
                                  'h2'=>'<strong>Pasul 3: </strong> Felicitari Testul tau a fost inregistrat!',
                                  'h3'=>'Acum poti incepe sa trimiti e-mailuri cu noul test.<br/> Selecteaza membru sa atasezi acest test !',
                              )
                        ),
              'top_quiz'=>array(
                        'h3'=>'Ajutor rapid &raquo; selecteaza testul pentru vizualizare top',
                        'select'=>'- Selecteaza test -',
                        'th1'=>'Membru',
                        'th2'=>'Grup',
                        'th3'=>'Nume test',
                        'th4'=>'Intrebari test',
                        'th5'=>'Punctaj',
                        'th6'=>'Timp folosit',
                        'th7'=>'Data completarii',
                        'th8'=>'Pozitie',
                        'error'=>'Momentan nu a completat nimeni acest test !'
                       ) ,
              'view_quiz'=>array(
                        'title'=>'Pentru a incepe, apasa START !',
                        'name'=>'Nume Test &raquo; ',
                        'category'=>'Categorie Test &raquo; ',
                        'time'=>'Timp pentru completare &raquo; ',
                        'questions'=>'Numar de intrebari &raquo; ',
                        'h'=>' ore : ',
                        'm'=>' minute',
                        'perfect'=> 'Perfect !',
                        'excellent'=> 'Nemaipomenit !',
                        'good'=> 'Cateva exceptii !',
                        'average'=> 'Acceptabil !',
                        'bad'=> 'Slab !',
                        'poor'=> 'Foarte slab !',
                        'worst'=> 'Incredibil de slab !',
                        'score'=>' Scorul tau este ',
                        'please'=>'Te rog selecteza un raspuns',
                        'finale'=>'Testul a fost completat cu succes',
                        'question'=>'Intrebare',
                        'info'=>'<p>Pentru completare acestui Test trebuie sa bifezi raspunsul care crezi ca este corect.</p>',
                        'info_multiple_answers'=>'<i><u><p>Atentionare !<p> Acest test are intrebari cu mai multe raspunsuri corecte , trebuie sa bifezi mai mult de un raspuns la unele intrebari !</u> </i>'    
              )          
);

//h1-title on loaded page 
$lang['lang_page_title'] =array('dashboard'=>array('h1'=>'Panoul Principal'),
                                'how_it_works'=>array('h1'=>'Cum functioneaza'),
                                'edit_profile'=>array('h1'=>'Setarile contului'),
                                'your_members'=>array('h1'=>'Administreaza Membrii'),
                                'add_member'=>array('h1'=>'Adauga noi membri'),
                                'manage_groups'=>array('h1'=>'Gestionati Grupurile'),
                                'manage_your_quiz'=>array('h1'=>'Gestionati Testele'),
                                'create_quiz'=>array('h1'=>'Creaza Test'),
                                'edit_quiz'=>array('h1'=>'Editeaza Test'),
                                'top_quiz'=>array('h1'=>'Top test'),
                                'inbox'=>array('h1'=>'Vizualizeaza mesajele')
);
$lang['date_differance']=array(
                        'year'=>' an in urma',
                        'years'=>' ani in urma',
                        'month'=>' luna in urma',
                        'months'=>' luni in urma',
                        'day'=>' zi in urma',
                        'days'=>' zile in urma',
                        'today'=>' astazi',
                        
);

$lang['inbox']=array(
                'messages'=>'Mesaje citite'
);

$lang['notification']=array(
                'quick_help'=>'Ajutor rapid',
                'info'=>' a completat testul primit . Acestea sunt datele in urma completarii ',
                'email'=>$lang['email_address'],
                'group'=>$lang['group'],
                'quiz_name'=>'Nume test',
                'question_nr'=>'Numar Intrebari',
                'score'=>'Scor',
                'time_used'=>'Timp Folosit',
                'complete_data'=>'Data completarii',
                'title'=>'Notificari',
                'title1'=>'Mesaje'
);


