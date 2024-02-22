@extends('web.common.main')

@section('title', 'Tips | Sun Security Services')

@section('customHeader')
@endsection

@section('main')
    <div class="container" id="security-tips">
        <div class="tips-heading">
            <h2>Security Tips</h2>
        </div>
        <div class="accordion mt-4" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left shadow-none" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"
                            style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>Missing Children:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <p class="ml-4">Rising cases of missing children has become a subject of great concern.
                            Educating the children about the issues of kidnapping and what one can do to escape such an
                            environment has become a necessity. We must not forget that our children cannot take care of
                            themselves; rather we have to take care for them.</p>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo" style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>Guidelines for Parents:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="ml-4">
                            <li>Never leave your child unattended in a car, home, market or any other public place.</li>
                            <li>Share quality time with each child, listen, and guide them through difficult periods.</li>
                            <li>Take pictures of your child at least once a year. If under the age of two, four times a
                                year. Always maintain a current photograph of your child.</li>
                            <li>Keep a note of his/her height, weight and colour of eyes.</li>
                            <li>Be aware of the identification marks like birthmarks, scars etc.</li>
                            <li>Try to be familiar with his/her daily routine. Be aware of his/her whereabouts at all times.
                            </li>
                            <li>Keep the addresses and phone numbers of your child's friends.</li>
                            <li>Know all possible details about your child's friends.</li>
                            <li>Ensure that small children carry a badge or identity card on the person having his/her name,
                                parents' name, address, and phone numbers on it.</li>
                            <li>Never assume that your child will never go missing.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree" style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>Immediate steps to be taken in case a child goes missing:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="ml-4">
                            <li>Time is of utmost importance and it could be the deciding factor in the child’s safe
                                recovery.</li>
                            <li>Immediately inform the police. This is crucial. A few hours can make the difference. Request
                                that you be kept informed regularly of the status of the investigation.</li>
                            <li>Hand over the latest photograph of the child along with all relevant details to the police.
                            </li>
                            <li>Check with your child's friends, school, neighbours, relatives, or anyone else who may know
                                of your child's whereabouts. Ask them to notify you if they hear from the child. Get as many
                                people as possible to search for the missing child. Give all possible details like the
                                clothes he/she was wearing.</li>
                            <li>Utilize Newspapers, TV, Posters at Railway Stations, Bus Stops, Taxi Stands to get the word
                                around as early as possible.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFour">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour" style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>Tips on Street Safety:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="ml-4">
                            <li>Don't carry more money or valuables than you can afford to lose.</li>
                            <li>Do not publicize.</li>
                            <li>Try to walk on the side of the street facing the approaching traffic.</li>
                            <li>If you are being followed, slow down, speed up then reverse your direction and indicate to
                                your pursuer that you are aware of his following you, then go straight to receive help from
                                other people.</li>
                            <li>If you are walking alone at night, do not walk near cars parked by the roadside or anything
                                that could possibly conceal a potential ambusher.</li>
                            <li>If you regularly go jogging or walk alone, and perceive any threat to your life, vary your
                                routes and timings to minimize the possibility of someone waiting to assault you.</li>
                            <li>When using public transportation, sit near a companion, fellow passenger or the conductor.
                                Avoid the seats near the exit as far as possible.</li>
                            <li>When seated near an open window, protect your belongings from being stolen by any person
                                reaching through the window.</li>
                            <li>Keep the approximate fare separately before you leave home. Avoid opening your handbag or
                                showing your wallet.</li>
                            <li>Be alert; remain vigilant to the surroundings around you. Keep your eyes and ears open till
                                you reach your destination.</li>
                            <li>While walking on the street, you can come across any type of unwarranted situation like
                                fire, riot, loot, brawl, etc. Resist the impulse to be a spectator and shield yourself
                                against the action.</li>
                            <li>If by any chance you are a witness to a crime, look for help. You should attempt to be of
                                assistance personally only if you are confident that there is no personal danger to you.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingFive">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                            aria-controls="collapseFive" style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>Security Tips for Senior Citizen:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>

                        </button>
                    </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                    <div class="card-body">
                        <ol class="ml-4">
                            <li>
                                <p style="font-weight: 600; font-size: 18px;">General:</p>
                            </li>
                            <ul class="ml-4">
                                <li>Do not display large amounts of cash in public.</li>
                                <li>If driving, plan your route carefully, travel on main roads, and use maps. Map two
                                    routes for each auto trip. One should be the quickest route, the other the most scenic.
                                    Avoid traveling during night hours.</li>
                                <li>While traveling, try to travel in groups. Even if you have to travel all by yourself, do
                                    not publicize the fact that you are traveling all by yourself.</li>
                                <li>Have your car serviced and tires checked before leaving. Keep car doors locked at all
                                    times. Wear seat belts. Don't drive too long.</li>
                            </ul>
                            <li>
                                <p style="font-weight: 600; font-size: 18px;">On the Street:</p>
                            </li>
                            <ul class="ml-4">
                                <li>Avoid dark, deserted or isolated routes.</li>
                                <li>Whether you're passenger or a driver, keep car doors locked. Be particularly alert in
                                    parking lots and garages. Park near an entrance.</li>
                                <li>Keep your money in several pockets instead of one pocket. Carry your purse close to your
                                    body, not dangling by the straps. Put a wallet in an inside coat or front pants pocket.
                                </li>
                                <li>Sit close to the driver or near the exit while riding the bus, train, or subway.</li>
                                <li>If someone or something makes you uneasy, trust your instincts and leave.</li>
                                <li>Project an image of self-confidence while walking.</li>
                                <li>If you felt that you are being followed, cross the street.</li>
                                <li>Never accept a ride from a stranger or unknown person.</li>
                                <li>Don't get out of the car if there are suspicious individuals nearby. Drive away. If you
                                    suspect someone is following you, drive to the nearest service station, restaurant, or
                                    business and call the police department. If you believe it is unsafe to get out of your
                                    car, honk your horn and flash your lights to draw attention.</li>
                                <li>Never pick up hitchhikers. Do not stop to offer help to a stranded motorist. Go to a
                                    telephone booth and call for assistance.</li>
                            </ul>
                            <li>
                                <p style="font-weight: 600; font-size: 18px;">At Home:</p>
                            </li>
                            <ul class="ml-4">
                                <li>Install good locks on doors and windows. Use them! Do not hide keys in mailboxes and
                                    planters or under doormats. Instead, leave an extra set of keys with a trusted neighbour
                                    or friend.</li>
                                <li>Never let a stranger into your home.</li>
                                <li>Ask for photo identification from service or delivery people before letting them in. If
                                    you are the least bit worried call the company to verify. Always ask for the
                                    identification badge or card before you allow a service technician into the house.</li>
                                <li>Keep all emergency numbers readily available close to landline phone or saved in mobile.
                                </li>
                                <li>Do not let people know on the phone that you are alone.</li>
                                <li>Leave a light on while you are out. Use a different light each time you are out.</li>
                                <li>If possible install a burglar alarm.</li>
                                <li>Install a “Magic Eye” on your main door.</li>
                                <li>If you are going to be away for more that one day, do not keep clothes hanging on the
                                    clotheslines.</li>
                                <li>Know the telephone numbers of your neighbours.</li>
                            </ul>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingEight">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseEight" aria-expanded="false"
                            aria-controls="collapseEight" style="text-decoration: none;">

                            <div class="d-flex justify-content-between">
                                <p>Tips for Earthquake Preparedness:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                    data-parent="#accordionExample">
                    <div class="card-body">
                        <ol class="ml-4">
                            <li>
                                <p style="font-weight: 600; font-size: 18px;">Check your home for potential hazards:</p>
                            </li>
                            <ul class="ml-3">
                                <li>Repair defective electrical wiring, leaky gas pipes, and inflexible connections. Bolt
                                    down water heaters and gas appliances.</li>
                                <li>Know where and how to shut off electricity, gas, and water at main switches and valves.
                                    Check with local utility companies for instructions.</li>
                                <li>Place large and heavy objects on lower shelves. Securely fasten shelves to walls. Brace
                                    or anchor high or top-heavy objects.</li>
                                <li>Store bottled goods, glass, china, and other breakables in low or closed cabinets.</li>
                                <li>Fasten overhead lighting fixtures, such as chandeliers, with wiring or an anchoring
                                    sill.</li>
                                <li>Repair deep plaster cracks in ceilings and foundations.</li>
                            </ul>
                            <li>
                                <p style="font-weight: 600; font-size: 18px;">Have on hand:</p>
                            </li>
                            <ul class="ml-3">
                                <li>A flashlight and battery-powered radio in case power is cut off.</li>
                                <li>A supply of drinking water and nonperishable foods that may be prepared without cooking.
                                </li>
                                <li>A fire extinguisher and first-aid kit.</li>
                                <li>Teach responsible family members how to turn off electricity, gas, and water at main
                                    switches and valves</li>
                            </ul>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingNine">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseNine" aria-expanded="false"
                            aria-controls="collapseNine" style="text-decoration: none;">

                            <div class="d-flex justify-content-between">
                                <p>Safety Tips during Earthquakes:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="ml-4">
                            <li>During an earthquake, assume the "earthquake position". If you are indoors, drop down to the
                                floor in the "earthquake position". Make yourself small, with your knees on the floor, and
                                your head tucked down toward the floor. Take cover under a sturdy desk or table. Place one
                                hand on a leg of the table (to keep it from shifting away from you) and one hand over the
                                back of your neck. Alternatively get down low next to a solid sofa or armchair and cover
                                your head and neck with a pillow. Stay clear of windows, fireplaces, wood stoves, and heavy
                                furniture or appliances that may fall over. Stay inside to avoid being injured by falling
                                glass or building parts.</li>
                            <li>If you are indoors, stay indoors; if you are outdoors, stay there. During earthquakes, most
                                injuries occur as people enter or leave buildings. If indoors, take cover under a
                                heavy desk, table, bench, in a supported doorway, or along an inside wall. Stay away from
                                glass and fireplaces. Do not use candles, matches, or other flame either during or after the
                                tremor because of possible gas leaks. Douse all fires.</li>
                            <li>If in a high-rise building, get under a desk or similar heavy furniture. Do not dash for
                                exits because stairways may be broken or jammed with people. Never use elevators because
                                power may fail.</li>
                            <li>Pick a safe place where things will not fall on you.</li>
                            <li>Never use the elevator to move out of a building. Use the stairs instead.</li>
                            <li>If outdoors, move away from buildings and power lines and streetlights. The greatest danger
                                from falling debris is just outside doorways and close to outer walls.</li>
                            <li>If in a moving car, stop as quickly as safety permits, but stay in the vehicle and keep low.
                                A car may jiggle violently on its springs, but it is a good place to stay until the shaking
                                stops. When you resume driving, watch for hazards created by the earthquake, such as fallen
                                or falling objects, downed electrical wires, or broken or undermined roadways.</li>
                            <li>Most important: STAY CALM. Think through the consequences of any action you take.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTen">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed shadow-none" type="button"
                            data-toggle="collapse" data-target="#collapseTen" aria-expanded="false"
                            aria-controls="collapseTen" style="text-decoration: none;">
                            <div class="d-flex justify-content-between">
                                <p>After an Earthquake:</p>
                                <p><i class="fa-solid fa-plus"></i></p>
                            </div>
                        </button>
                    </h2>
                </div>
                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul class="ml-4">
                            <li>Be prepared for additional earthquake tremors, or "aftershocks." Although most of these are
                                smaller than the mainshock, some may be large enough to cause additional damage or bring
                                weak structures down.</li>
                            <li>Check for injuries. Do not attempt to move seriously injured persons unless they are in
                                immediate danger of further injury.</li>
                            <li>Turn on your radio or television to get the latest emergency information from local
                                authorities.</li>
                            <li>Check your utilities. The earthquake may have broken gas, electrical, and water lines. If
                                you smell gas, open windows and shut off the main gas valve. Then leave the building and
                                report the leakage to authorities. Do not reenter the building until a utility official says
                                it is safe. If electrical wiring is shorting out, shut off current at the main meter box. If
                                water pipes are damaged, shut off the supply at the main valve.</li>
                            <li>Check to see that sewage lines are intact before using sanitary facilities.</li>
                            <li>Do not touch downed power lines or objects in contact with downed lines.</li>
                            <li>Immediately clean up spilled medicines, drugs, flammable liquids, and other potentially
                                hazardous materials.</li>
                            <li>Use the telephone only for genuine emergency calls. Do not spread rumours; they often do
                                great harm after disasters</li>
                            <li>Stay away from damaged areas. Your presence could hamper emergency relief efforts, and you
                                could be putting yourself in personal danger. Cooperate fully with public-safety officials.
                                Respond to requests for volunteer assistance from police and fire-fighting, civil-defense,
                                and relief organizations, but do not go into damaged areas unless your assistance has been
                                requested.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
@endsection
