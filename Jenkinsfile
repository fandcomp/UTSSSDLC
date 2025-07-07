pipeline {
    agent any
    environment {
        SONAR_TOKEN = credentials('sonarqube-token')
    }
    stages {
        stage('Checkout') {
            steps { git 'https://github.com/<user>/<repo>.git' }
        }
        stage('Install Dependencies') {
            steps { bat 'composer install' }
        }
        stage('Run PHPUnit') {
            steps { bat 'vendor\\bin\\phpunit --configuration phpunit.xml' }
        }
        stage('SonarQube Analysis') {
            steps {
        withSonarQubeEnv('SonarQube') {
            bat '"D:\\POLTEKSSN\\TINGKAT 3\\SEM 2\\SSDLC\\sonar-scanner-7.1.0.4889-windows-x64\\bin\\sonar-scanner.bat"'
                }
            }
        }}
    post {
        failure { echo 'Pipeline gagal, cek log.' }
    }
}
