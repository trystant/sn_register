/*
  Author: <name>
  Course: {135,136}
  Instructor: <Micheal Kadri>
  Assignment: <Lab7>

  This program reads user string input and check if
   1. it reads forwards as backwords by words 
   2. it has any duplicate word then removes it
   3. it has grammatical error, "i", and change to "I"
   4. it has "instructor" and changes to professor's name
    
  The possible pre-conditions:
   1. starts with a single or more spaces(checked)
   2. user enters an empty string(checked)
   3. 
   
   
  Test case: "    i am am am what am i ";
   result: 
   
*/

#include <iostream>
#include <vector>
using namespace std;

void backWords(vector<string> &input, vector<string> &back);
void toWords(string, vector <string> &back);
bool backcheck(vector <string> &input, vector <string> &back);
void dupcheck(vector <string> &input);
void iCheck(vector <string> &input);
void instructor(vector <string> &input);
void shout(bool);
void read(vector <string> &input); 

int main(){

   string x;
   cout<<"Enter string: ";
   getline(cin,x);
   while(x.length()==0){
         cout<<"Please enter a sentence: ";
         getline(cin,x);
   }
      
   vector <string> input(0);
   vector <string> back(0);

   toWords(x,input);
   //task 1
   backWords(input, back);
   shout(backcheck(input, back));
   
   //task 2
   dupcheck(input);
   
   //task 3
   iCheck(input);
   
   //task 4
   instructor(input);
   backWords(input, back);
   shout(backcheck(input, back));
    
   read(input);
   read(back);

   return 0;
}

void toWords(string x, vector <string> &input){
   string container="";
   for(int i=0;i<x.length();i++){
      if(x[i]!=' '){
         container+=x[i];
      } else if(x[i]==' '){
         if(container==""){
               continue;
         }
         input.push_back(container);
         container="";
      }
   }
   input.push_back(container);
   return;
}

void backWords(vector<string> &input, vector<string> &back){
      back.resize(0);
      for(int i=input.size()-1;i>=0;i--){
            back.push_back(input[i]);
      }
      return;
}

bool backcheck(vector <string> &input, vector <string> &back){
   for(int i=0;i<input.size();i++){
      if(input[i]!=back[i]){
         return false;
      }
   }
   return true;
}

void dupcheck(vector <string> &input){
   vector <string> x(0); //empty vector
   x.push_back(input[0]);
   for(int i=1;i<input.size();i++){

      if(input[i-1]==input[i]){
         //do nohting
      } else{
         x.push_back(input[i]);
      }
   }

   input.resize(0);
   for(int j=0;j<x.size();j++){
      input.push_back(x[j]);
   }

}

void iCheck(vector <string> &input){
      for(int i=0;i<input.size();i++){
            if(input[i]=="i"){
                  input[i]="I";
            }
      }
      return;
}

void instructor(vector <string> &input){
      for(int i=0;i<input.size();i++){
            if(input[i]=="instructor"){
                  input[i]="Professor Michael Kadri";
            }
      }      
      return;
}

void shout(bool que){
      cout<<"Task 1 backward compatibility check..."<<endl;
      if(que){
            cout<<"Matches!"<<endl;
      } else{
            cout<<"Does NOT match!"<<endl;
      }
      return;
}

void read(vector <string> &input){
      for(int j=0;j<input.size();j++){
            cout<<input[j]<<" ";
      }
      cout<<endl;
      
      return;
}