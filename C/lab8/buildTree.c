#include "as8.h"
#include <math.h>
MTREE* buildTree(MTREE* tree) {

	NODE* newPtr;
	newPtr = NULL;
	if (tree == NULL)
	{
		tree = (MTREE*)malloc(sizeof(MTREE));
		tree->root = NULL;
		tree->count = 0;
	}
	if (tree->root == NULL) {
		newPtr = (NODE*)malloc(sizeof(NODE));
		newPtr->numEntries = 1;
		newPtr->entries[0].data = rand() % 50;
		tree->root = newPtr;
		(tree->count)++;
		return tree;
	}
	
	tree->root = newPtr;
	
	while (newPtr) {
		if (newPtr = NULL) {
			newPtr = (NODE*)malloc(sizeof(NODE));
			newPtr->numEntries = 1;
			newPtr->entries[0].data = rand() % 50;
			return tree;
		}
		else if (newPtr->numEntries < 5) {
			int temp = newPtr->numEntries;
			newPtr->entries[temp].data = rand() % 50;
			return tree;
		}
		else {
			newPtr = (NODE*)malloc(sizeof(NODE));
			newPtr->numEntries = 1;
			newPtr->entries[0].data = rand() % 50;
			return tree;
		}

	}
}