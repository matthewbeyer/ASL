<?php $customCss = ["login", "animate-custom", "terms"]; ?>
<?php $customJs  = ["placeholder-shim", "custom2"]; ?>
@extends('layout')

@section('title')
Terms | Honey May I
@stop

@section('content')

<!-- start Login box -->
<div class="container" id="login-block">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-2">
            <h3 class="animated bounceInDown">Terms and Conditions</h3>
            <div class="login-box terms clearfix animated flipInY">
                <div class="login-logo">
                    <a href="/"><img src="/images/hmilogo.png" alt="Honey May I" /></a>
                </div>
                <hr />
                <ol id="termsp">
                    <li>
                        This page (together with the documents referred to on it) tells you the terms of use
                        (the “<b>Terms of Use</b>”) on which you may make use of our “Honey May I” application for
                        mobile devices and web (the “<b>App</b>”).
                        Please read these Terms of Use carefully before you download, install or use the App.
                        By downloading, installing or using the App, you indicate that you accept these Terms of Use
                        and that you agree to abide by them.
                        Your download, installation or use of the App constitutes your acceptance of these
                        Terms of Use which takes effect on the date on which you download, install or use the App.
                        If you do not agree with these Terms of Use, you should cease downloading, installing or
                        using the App immediately.
                    </li>
                    <li>
                        The App is operated by Honey May I (and we refer to ourselves as “<b>we</b>”, “<b>us</b>”
                        or “<b>our</b>”).
                        We own and operate the App on our own behalf.
                    </li>
                    <li>
                        We reserve the right to change these Terms of Use at any time without notice to you by posting
                        changes on the <a href="http://www.honeymayi.com">www.honeymayi.com</a> website
                        (the “<b>Website</b>”) or by updating the App to incorporate the new terms of use.
                        You are responsible for regularly reviewing information posted online to obtain timely notice
                        of such changes.
                        Your continued use of the App after changes are posted constitutes your acceptance of the
                        amended Terms of Use.
                    </li>
                    <li>
                        To download, install, access or use the App, you must be 18 years of age or over.
                        If you are under 18 and you wish to use download, install, access or use the App, you must get
                        consent from your parent or guardian before doing so.
                    </li>
                    <li>
                        We operate the software underlying and required for your use of the App from the United States
                        of America and it is possible that some downloads from the App could be subject to government
                        export controls or other restrictions.
                        If you download anything from or use the App, you represent that you are not subject to such
                        controls or restrictions.
                        We make no representation that anything is appropriate, permissible or available for use outside
                        the United States, and using the App from territories in which such use or the information
                        available from such use is illegal, restricted or not permitted, is expressly prohibited.
                        If you choose to access or use the App from or in locations outside of the United States, you
                        do so on your own initiative and are responsible for:
                        <ol>
                            <li>
                                ensuring that what you are doing in that country is legal; and
                            </li>
                            <li>
                                the consequences and compliance by you with all applicable laws, regulations, byelaws,
                                codes of practice, licences, registrations, permits and authorisations
                                (including any laws that relate to businesses providing services).
                            </li>
                            <li>
                                all access to the App through your mobile device and for bringing these Terms of Use to
                                the attention of all such persons.
                            </li>
                        </ol>
                    </li>
                    <li>
                        Use of the App does not include the provision of a mobile device or other necessary equipment
                        to access it.
                        To use the App you will require Internet connectivity and appropriate telecommunication links.
                        We shall not have any responsibility or liability for any telephone or other costs you may incur.
                    </li>
                    <li>
                        You shall not in any way use the App or submit to us or to the App or to any user of the App
                        anything which in any respect:
                        <ol>
                            <li>is in breach of any law, statute, regulation or byelaw of any applicable jurisdiction;</li>
                            <li>is fraudulent, criminal or unlawful;</li>
                            <li>is inaccurate or out-of-date;</li>
                            <li>may be obscene, indecent, pornographic, vulgar, profane, racist, sexist,
                                discriminatory, offensive, derogatory, harmful, harassing, threatening, embarrassing,
                                malicious, abusive, hateful, menacing, defamatory, untrue or political;</li>
                            <li>impersonates any other person or body or misrepresents a relationship with any person or body;</li>
                            <li>may infringe or breach the copyright or any intellectual property rights
                                (including without limitation copyright, trademark rights and broadcasting rights) or
                                privacy or other rights of us or any third party;</li>
                            <li>may be contrary to our interests;</li>
                            <li>is contrary to any specific rule or requirement that we stipulate on the App in relation
                                to a particular part of the App or the App generally; or</li>
                            <li>involves your use, delivery or transmission of any viruses, unsolicited emails, trojan
                                horses, trap doors, back doors, easter eggs, worms, time bombs, cancelbots or computer
                                programming routines that are intended to damage, detrimentally interfere with,
                                surreptitiously intercept or expropriate any system, data or personal information.</li>
                        </ol>
                    </li>
                    <li>You agree not to reproduce, duplicate, copy or re-sell the App or any part of the App save as
                        may be permitted by these Terms of Use.</li>
                    <li>
                        You agree not to access without authority, interfere with, damage or disrupt:
                        <ol>
                            <li>any part of the App;</li>
                            <li>any equipment or network on which the App is stored;</li>
                            <li>any software used in the provision of the App; or</li>
                            <li>any equipment or network or software owned or used by any third party.</li>
                        </ol>
                    </li>
                    <li>You hereby grant to us an irrevocable, royalty-free, worldwide, assignable, sub-licensable
                        licence to use any material which you submit to us or the App for the purpose of use on the App
                        or for generally marketing (by any means and in any media, including, but not limited to, on our
                        website or in our journals) our services. You agree that you waive your moral rights to be
                        identified as the author and we may modify your submission.</li>
                    <li>Commentary and other materials available on the App are not intended to amount to advice on
                        which reliance should be placed. Subject to paragraphs 32 and 33 below, we therefore disclaim
                        all liability and responsibility arising from any reliance placed on such materials by any user
                        of the App, or by anyone who may be informed of any of its contents.</li>
                    <li>You assume sole responsibility for results obtained from the use of the App, and for conclusions
                        drawn from such use. We shall have no liability for any damage caused by errors or omissions in
                        any information, instructions or scripts provided to us by you in connection with the App, or
                        any actions taken by us at your direction.</li>
                    <li>You agree to comply at all times with any instructions for use of the App which we make from
                        time to time.</li>
                    <li>
                        If you choose, or you are provided with, a user identification code, password or any other piece
                        of information as part of our security procedures, you must treat such information as
                        confidential, and you must not disclose it to any third party. We have the right to disable any
                        user identification code or password, whether chosen by you or allocated by us, at any time,
                        if in our opinion you have failed to comply with any of the provisions of these Terms of Use.
                    </li>
                    <b>Vailability of the App, Security & Accuracy</b>
                    <li>We make no warranty that your access to the App will be uninterrupted, timely or error-free.
                        Due to the nature of the Internet, this cannot be guaranteed.
                        In addition, we may occasionally need to carry out repairs, maintenance or introduce new
                        facilities and functions.</li>
                    <li>Access to the App may be suspended or withdrawn to or from you personally or all users
                        temporarily or permanently at any time and without notice.
                        We may also impose restrictions on the length and manner of usage of any part of the App for
                        any reason. If we impose restrictions on you personally, you must not attempt to use the App
                        under any other name or user or on any other mobile device.</li>
                    <li>
                        We do not warrant that the App will be compatible with all hardware and software which you may
                        use.
                        We shall not be liable for damage to, or viruses or other code that may affect, any equipment
                        (including but not limited to your mobile device), software, data or other property as a result
                        of your download, installation, access to or use of the App or your obtaining any material from,
                        or as a result of using, the App. We shall also not be liable for the actions of third parties.
                    </li>
                    <li>We may change or update the App and anything described in it without notice to you.
                        If the need arises, we may suspend access to the App, or close it indefinitely.</li>
                    <li>We make no representation or warranty, express or implied, that information and materials on
                        the App are correct, no warranty or representation, express or implied, is given that they are
                        complete, accurate, up-to-date, fit for a particular purpose and, to the extent permitted by
                        law, we do not accept any liability for any errors or omissions. This shall not affect any
                        obligation which we may have under any contract that we may have with you to provide you with
                        products.</li>
                    <b>Independence from Platforms</b>
                    <li>The App is independent of any platform on which it is located.
                        The App is not associated, affiliated, sponsored, endorsed or in any way linked to any platform
                        operator, including, without limitation, Apple, Google, Android or RIM Blackberry
                        (each being an “<b>Operator</b>”).</li>
                    <li>Your download, installation, access to or use of the App is also bound by the terms and
                        conditions of the Operator.</li>
                    <li>You and we acknowledge that these Terms of Use are concluded between you and us only, and not
                        with an Operator, and we, not those Operators, are solely responsible for the App and the
                        content thereof to the extent specified in these Terms of Use.</li>
                    <li>
                        We are solely responsible for providing any maintenance and support services with respect to
                        the App as required under applicable law. You and we acknowledge that an Operator has no
                        obligation whatsoever to furnish any maintenance and support services with respect to the App.
                    </li>
                    <li>
                        In the event of any failure of the App to conform to any applicable warranty, you may notify
                        the relevant Operator and that Operator will refund the purchase price for the App (if any
                        purchase price has been paid) to you; and, to the maximum extent permitted by applicable law,
                        that Operator will have no other warranty obligation whatsoever with respect to the App, and
                        any other claims, losses, liabilities, damages, costs or expenses attributable to any failure
                        to conform to any warranty will be our sole responsibility.
                    </li>
                    <li>
                        You and we acknowledge that we, not the relevant Operator, are responsible for addressing any
                        claims of you or any third party relating to the App or your possession and/or use of the App,
                        including, but not limited to: (i) any claim that the App fails to conform to any applicable
                        legal or regulatory requirement; and (ii) claims arising under consumer protection or similar
                        legislation.
                    </li>
                    <li>
                        You and we acknowledge that, in the event of any third party claim that the App or your
                        possession and use of the App infringes that third party’s intellectual property rights, we,
                        not the relevant Operator, will be solely responsible for the investigation, defense, settlement
                        and discharge of any such intellectual property infringement claim; provided such infringement
                        was caused by us.
                    </li>
                    <li>You must comply with any applicable third party terms of agreement when using the App
                        (e.g. you must ensure that your use of the App is not in violation of your mobile device
                        agreement or any wireless data service agreement).
                    </li>
                    <li>You and we acknowledge and agree that the relevant Operator, and that Operator’s subsidiaries,
                        are third party beneficiaries of these Terms of Use, and that, upon your acceptance of these
                        Terms of Use, that Operator will have the right (and will be deemed to have accepted the right)
                        to enforce these Terms of Use against you as a third party beneficiary thereof.
                    </li>
                    <b>Limitation of Liability</b>
                    <li>You hereby release Honey May I., its officers, directors, agents, and employees from all claims,
                        demands, and damages (actual and consequential) of any kind and nature, known and unknown,
                        suspected and unsuspected, disclosed and undisclosed, arising out of, or in any way, connected
                        with any disputes arising between you and any suppliers, or between you and other App or Website
                        users.
                    </li>
                    <li>YOU ASSUME ALL RESPONSIBILITY AND RISK WITH RESPECT TO YOUR USE OF THE APP.
                        THE APP IS AVAILABLE “AS IS,” AND “AS AVAILABLE”.
                        YOU UNDERSTAND AND AGREE THAT, TO THE FULLEST EXTENT PERMITTED BY LAW, WE DISCLAIM ALL
                        WARRANTIES, REPRESENTATIONS AND ENDORSEMENTS, EXPRESS OR IMPLIED, WITH REGARD TO THE SITE,
                        INCLUDING, WITHOUT LIMITATION, IMPLIED WARRANTIES OF TITLE, MERCHANTABILITY, NON-INFRINGEMENT
                        AND FITNESS FOR A PARTICULAR PURPOSE.  WE DO NOT WARRANT USE OF THE SITE WILL BE UNINTERRUPTED
                        OR ERROR-FREE OR THAT ERRORS WILL BE DETECTED OR CORRECTED. WE DO NOT ASSUME ANY LIABILITY OR
                        RESPONSIBILITY FOR ANY COMPUTER VIRUSES, BUGS, MALICIOUS CODE OR OTHER HARMFUL COMPONENTS,
                        DELAYS, INACCURACIES, ERRORS OR OMISSIONS, OR THE ACCURACY, COMPLETENESS, RELIABILITY OR
                        USEFULNESS OF THE INFORMATION DISCLOSED OR ACCESSED THROUGH THE APP.  WE HAVE NO DUTY TO UPDATE
                        OR MODIFY THE APP AND WE ARE NOT LIABLE FOR OUR FAILURE TO DO SO. IN NO EVENT, UNDER NO LEGAL
                        OR EQUITABLE THEORY (WHETHER TORT, CONTRACT, STRICT LIABILITY OR OTHERWISE), SHALL WE OR ANY OF
                        OUR RESPECTIVE EMPLOYEES, DIRECTORS, OFFICERS, AGENTS OR AFFILIATES, BE LIABLE HEREUNDER OR
                        OTHERWISE FOR ANY LOSS OR DAMAGE OF ANY KIND, DIRECT OR INDIRECT, IN CONNECTION WITH OR ARISING
                        FROM THE APP, THE USE OF THE APP OR OUR AGREEMENT WITH YOU CONCERNING THE APP, INCLUDING, BUT
                        NOT LIMITED TO, COMPENSATORY, DIRECT, CONSEQUENTIAL, INCIDENTAL, INDIRECT, SPECIAL OR PUNITIVE
                        DAMAGES, LOST ANTICIPATED PROFITS, LOSS OF GOODWILL, LOSS OF DATA, BUSINESS INTERRUPTION,
                        ACCURACY OF RESULTS, OR COMPUTER FAILURE OR MALFUNCTION, EVEN IF WE HAVE BEEN ADVISED OF OR
                        SHOULD HAVE KNOWN OF THE POSSIBILITY OF SUCH DAMAGES.   IF WE ARE HELD LIABLE TO YOU IN A
                        COURT OF COMPETENT JURISDICTION FOR ANY REASON, IN NO EVENT WILL WE BE LIABLE FOR ANY DAMAGES
                        IN EXCESS OF ONE HUNDRED FIFTY DOLLARS (US$150.00).  SOME JURISDICTIONS DO NOT ALLOW THE
                        LIMITATION OR EXCLUSION OF LIABILITY FOR CONSEQUENTIAL OR INCIDENTAL DAMAGES, SO THE ABOVE
                        LIMITATION OR EXCLUSION MAY NOT APPLY TO YOU. IF ANY LIMITATION ON REMEDIES, DAMAGES OR
                        LIABILITY IS PROHIBITED OR RESTRICTED BY LAW, WE SHALL REMAIN ENTITLED TO THE MAXIMUM
                        DISCLAIMERS AND LIMITATIONS AVAILABLE UNDER THIS AGREEMENT, AT LAW AND/OR IN EQUITY.
                    </li>
                    <b>Your Representations and Warranties</b>
                    <li>You represent and warrant that (a) your use of the App will be in strict accordance with this
                        Agreement and with all applicable laws and regulations, including without limitation any local
                        laws or regulations in your country, state, city, or other governmental area, regarding online
                        conduct and acceptable content, and regarding the transmission of technical data exported from
                        the United States or the country in which you reside and (b) your use of the App will not
                        infringe or misappropriate the intellectual property rights of any third party.
                    </li>
                    <b>Indemnification</b>
                    <li>
                        You agree to indemnify and hold Honey May I. and each of our affiliates, successors and
                        assigns, and their respective officers, directors, employees, agents, representatives,
                        licensors, advertisers, suppliers, and operational service providers harmless from and
                        against any and all losses, expenses, damages, costs and expenses (including attorneys' fees),
                        resulting from your use of the App and/or any violation of the terms of this Agreement.
                        We reserve the right to assume the exclusive defense and control of any demand, claim or action
                        arising hereunder or in connection with the App and all negotiations for settlement or compromise.
                        You agree to fully cooperate with us in the defense of any such demand, claim, action,
                        settlement or compromise negotiations, as requested by us.
                    </li>
                    <b>Trade Marks</b>
                    <li>
                        The “Honey May I" name and logos and all related names, trademarks, service marks, design marks
                        and slogans are the trademarks or service marks of us or our licensors.
                    </li>
                    <b>Intellectual Property Rights</b>
                    <li>As between you and us, we are the sole and exclusive owner or the licensee of all intellectual
                        property rights in the App, and in the material published on it.
                        Those works are protected by copyright and trademark laws and treaties around the world.
                        All such rights are reserved.
                    </li>
                    <li>
                        You may print off one copy, and may download extracts, of any page(s) from the App for your
                        personal reference and you may draw the attention of others within your organisation to
                        material available on the App.
                    </li>
                    <li>You must not modify the paper or digital copies of any materials you have printed off or
                        downloaded in any way, and you must not use any illustrations, photographs, video or audio
                        sequences or any graphics separately from any accompanying text.</li>
                    <li>
                        You must not use any part of the materials on the App for commercial purposes without
                        obtaining a licence to do so from us or our licensors.
                    </li>
                    <li>
                        If you print off, copy or download any part of the App in breach of these Terms of Use,
                        your right to use the App will cease immediately and you must, at our option,
                        return or destroy any copies of the materials you have made.
                    </li>
                    <b>Information About You &amp; Your Use of the App</b>
                    <li>
                        We process information about you in accordance with our privacy policies which is available on
                        our website at <a href="www.honeymayi.com">www.honeymayi.com</a>.
                        By using the App, you consent to such processing and you
                        warrant that all data provided by you is accurate.
                    </li>
                    <b>Third Party Websites</b>
                    <li>We have no control over and accept no responsibility for the content of any website or mobile
                        application to which a link from the App exists (unless we are the provider of those linked
                        websites or mobile applications). Such linked websites and mobile applications are provided
                        “as is” for your convenience only with no warranty, express or implied, for the information
                        provided within them. We do not provide any endorsement or recommendation of any third party
                        website or mobile application to which the App provides a link. The terms and conditions,
                        terms of use and privacy policies of those third party websites and mobile applications will
                        apply to your use of those websites and mobile applications and any orders you make for goods
                        and services via such websites and mobile applications. If you have any queries, concerns or
                        complaints about such third party websites or mobile applications (including, but not limited
                        to, queries, concerns or complaints relating to products, orders for products, faulty products
                        and refunds) you must direct them to the operator of that third party website or mobile
                        application.
                    </li>
                    <li>
                        You must not without our permission:
                        <ul>
                            <li>use or copy any material from the App, including, but not limited to, onto other websites or in other mobile applications; or</li>
                            <li>frame any of the App onto your own or another person’s website or mobile application.</li>
                        </ul>
                    </li>
                    <b>Severability</b>
                    <li>If any of these terms should be determined to be illegal, invalid or otherwise unenforceable
                        by reason of the laws of any state or country in which these terms are intended to be effective,
                        then to the extent and within the jurisdiction which that term is illegal, invalid or
                        unenforceable, it shall be severed and deleted and the remaining Terms of Use shall survive,
                        remain in full force and effect and continue to be binding and enforceable.
                    </li>
                    <b>Non-assignment</b>
                    <li>You shall not assign or transfer or purport to assign or transfer the contract between
                        you and us to any other person.</li>
                    <b>Exclusion</b>
                    <li>Except as expressly stated in these Terms of Use, all warranties and conditions, whether
                        express or implied by statute, common law or otherwise are hereby excluded to the
                        extent permitted by law.</li>
                    <b>Miscellaneous</b>
                    <li>These Terms of Use (and our Privacy Policy, our Website Terms of Use, our Website Terms and
                        Conditions, any other document referred to in these Terms of Use and any other terms and
                        conditions specifically agreed between you and us in writing) contain all the terms agreed
                        between us and you regarding their subject matter and supersedes and excludes any prior terms
                        and conditions, understanding or arrangement between us and you, whether oral or in writing.
                        No representation, undertaking or promise shall be taken to have been given or be implied from
                        anything said or written in negotiations between us and you prior to these Terms of Use except
                        as expressly stated in these Terms of Use.  Neither us nor you shall have any remedy in respect
                        of any untrue statement made by the other upon which that party relied in entering into these
                        Terms of Use (unless such untrue statement was made fraudulently or was as to a matter
                        fundamental to a party’s ability to perform these Terms of Use) and that party’s only remedies
                        shall be for breach of contract as provided in these Terms and Conditions.</li>
                    <li>These Terms of Use may only be modified by a written amendment signed by an authorized executive
                        of the Company or by the posting of a revised version by us. Except to the extent applicable
                        law, if any, provides otherwise, this Agreement and any access to or use of the App.
                        All dealings, correspondence and contacts between us shall be made or conducted in the English
                        language.  . If any part of this Agreement is held invalid or unenforceable, that part will be
                        construed to reflect the parties' original intent, and the remaining portions will remain in
                        full force and effect. A waiver by either party of any term or condition of this Agreement or
                        any breach thereof, in any one instance, will not waive such term or condition or any subsequent
                        breach thereof. You may not assign your rights under this Agreement to any party; We may assign
                        our rights under this Agreement without condition. This Agreement will be binding upon and will
                        inure to the benefit of the parties, their successors, and permitted assigns.</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<!-- End Login box -->
<footer class="container">
    <p id="footer-text"><small>Copyright &copy; 2014 <a href="http://www.beyerbuilds.com">Beyer Builds</a></small></p>
</footer>

@stop