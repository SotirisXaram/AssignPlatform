<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" encoding="UTF-8" indent="yes" />

  <xsl:template match="/">
    <html lang="el">
      <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Προφίλ Φοιτητή</title>
        <style>
          :root {
            --primary-color: #1e3a8a;
            --secondary-color: #e0f2fe;
            --accent-color: #2563eb;
            --text-color: #1f2937;
            --background-color: #f9fafb;
            --card-bg: #ffffff;
            --border-radius: 12px;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
          }

          body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
          }

          .wrapper {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 1rem;
          }

          header {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            text-align: center;
          }

          header h1 {
            margin: 0;
            font-size: 2rem;
          }

          section {
            background-color: var(--card-bg);
            padding: 1.5rem;
            margin-top: 1.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
          }

          section h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
          }

          .info p,
          .social p,
          .assignment p {
            margin: 0.5rem 0;
          }

          .assignment-card {
            border-left: 5px solid var(--accent-color);
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: var(--secondary-color);
            border-radius: var(--border-radius);
            transition: background 0.3s ease;
          }

          .assignment-card:hover {
            background-color: #dbeafe;
          }

          .assignment-card h3 {
            margin-top: 0;
            color: var(--primary-color);
          }

          .summary {
            font-weight: 600;
            background-color: var(--secondary-color);
            padding: 1rem;
            border-left: 4px solid var(--primary-color);
            border-radius: var(--border-radius);
          }

          @media (max-width: 600px) {
            header h1 {
              font-size: 1.5rem;
            }

            section h2 {
              font-size: 1.2rem;
            }
          }
        </style>
      </head>
      <body>
        <div class="wrapper">
          <header>
            <h1>Προφίλ Φοιτητή: <xsl:value-of select="student_profile/profile_info/full_name"/></h1>
          </header>

          <section class="summary">
            Συνολικός αριθμός υποβληθεισών εργασιών:
            <xsl:value-of select="count(student_profile/submitted_assignments/assignment)"/>
          </section>

          <section class="info">
            <h2>Πληροφορίες Προφίλ</h2>
            <p><strong>Ονοματεπώνυμο:</strong> <xsl:value-of select="student_profile/profile_info/full_name"/></p>
            <p><strong>Επάγγελμα:</strong> <xsl:value-of select="student_profile/profile_info/occupation"/></p>
          </section>

          <section class="social">
            <h2>Κοινωνικά Δίκτυα</h2>
            <p><strong>LinkedIn:</strong> <xsl:value-of select="student_profile/profile_info/social_media/linkedin"/></p>
            <p><strong>Facebook:</strong> <xsl:value-of select="student_profile/profile_info/social_media/facebook"/></p>
            <p><strong>YouTube:</strong> <xsl:value-of select="student_profile/profile_info/social_media/youtube"/></p>
            <p><strong>Instagram:</strong> <xsl:value-of select="student_profile/profile_info/social_media/instagram"/></p>
            <p><strong>Twitter:</strong> <xsl:value-of select="student_profile/profile_info/social_media/twitter"/></p>
          </section>

          <section class="assignments">
            <h2>Υποβληθείσες Εργασίες</h2>
            <xsl:for-each select="student_profile/submitted_assignments/assignment">
              <div class="assignment-card">
                <h3><xsl:value-of select="title"/></h3>
                <p><xsl:value-of select="description"/></p>
                <p><strong>Αρχείο Υποβολής:</strong> <xsl:value-of select="submission_file"/></p>
                <p><strong>Ημερομηνία Υποβολής:</strong> <xsl:value-of select="submission_date"/></p>
              </div>
            </xsl:for-each>
          </section>
        </div>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>
